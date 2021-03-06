<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;


use App\ProductRequest;
use App\ProductList;
use App\Chef;
use App\RestoChef;
use App\StockManager;
use App\User;
use DB;
use Auth;

class ProductRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $productRequests = productRequest::latest()->paginate(25);
        $user=Auth::user();
        if($user->userable_type=="App\Admin"){
            $productRequests = productRequest::latest()->paginate(25);  
            return view('productRequest.index',['productRequests'=>$productRequests] ); 
        }
        else{

       
       
        $myRequests = productRequest::Where("user_id", $user->id)->latest()->paginate(25);   
           
              
        $requestedProducts = productRequest::Where("requested_to", $user->id)->latest()->paginate(25);
       
        return view('productRequest.index',['requestedProducts'=>$requestedProducts,'myRequests'=>$myRequests] );
        }

        
    }


    public function my_requests()
    {
        // $productRequests = productRequest::latest()->paginate(25);
        $user=Auth::user();
       
        $productRequests = productRequest::Where("user_id", $user->id)->latest()->paginate(25);   
       
        return view('productRequest.my', compact('productRequests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         $products=ProductList::all();
         return view('productRequest.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            
            'title'=> 'required',
            'requestTo'=>'required',
            'person'=>'required',
        ]);
   
        $requestProduct= new ProductRequest;
       
            $requestProduct->requested_to=$request->person;
            $requestProduct->description=$request->description;
            $requestProduct->title=$request->title;
            // $requestProduct->reference=$request->reference;
            $requestProduct->description=$request->description;
            $requestProduct->user_id=Auth::user()->id;
            $requestProduct->save();

            $quantity=$request->quantity;
            $product=$request->product;

            for($i=0 ; $i < count($product); $i++){
              $data =[
                  'product_request_id' => $requestProduct->id,
                  'product_list_id' => $product[$i],
                  'quantity' => $quantity[$i],
              ] ;
              
            //   $requestedProduct 
              DB::table('requested_products')->insert($data);
            }


            return redirect()->route('requests.index')->withStatus('Your request submitted successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($request)
    {
       
        $product = ProductRequest::find($request);
        
        return view('productRequest.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($request)
    {
        $product = ProductRequest::find($request);
        $products=ProductList::all();
        
        return view('productRequest.edit', compact('product', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($request)
    {
        $product = ProductRequest::find($request);
        $product->delete();
        return redirect()->route('requests.index')->withStatus('Your request deleted successfully.');
    }




    public function myform($id)

    {

        if($id=="chef"){
        $requestTo=User::where("userable_type","App\Chef")->get();
        return json_encode($requestTo);
        }

        elseif($id=="waiter"){
            $requestTo=User::where("userable_type","App\Waiter")->get();
            return json_encode($requestTo);

        }
        elseif($id=="stockManager"){
            $requestTo=User::where("userable_type","App\stockManager")->get();
            return json_encode($requestTo);

        }
        elseif($id=="restoChef"){
            $requestTo=User::where("userable_type","App\RestoChef")->get();
            return json_encode($requestTo);

        }

        elseif($id=="houseKeeper"){
            $requestTo=User::where("userable_type","App\HouseKeeper")->get();
            return json_encode($requestTo);

        }
        elseif($id=="waiter"){
            $requestTo=User::where("userable_type","App\Waiter")->get();
            return json_encode($requestTo);

        }

        else{
            $requestTo=User::where("userable_type","App\Accountant")->get();
            return json_encode($requestTo);

        }
        //return view('myform',compact('states'));

    }


    /**

     * Get Ajax Request and restun Data

     *

     * @return \Illuminate\Http\Response

     */

    public function myformAjax($id)

    {
        //  $requestTo = DB::table("users")
        // ->where("id",$id)
        // ->pluck("email","id");

        // echo "hhhhhhhhhhhhhhhhhhhh :" .$id;

    //    if($id.trim()=="chef"){
    //     $requestTo = DB::table("users")
    //     ->where("userable_type","App\Chef")
    //     ->pluck("email","id");
        
    //     return response()->json($requestTo);  
    //    }

    //   else{  $requestTo = DB::table("users")
    //     ->where("userable_id",1)
    //     ->pluck("email","id");
        
        //return response()->json($requestTo);

      
    
    }

    public function download($id){
        $product = ProductRequest::find($id);

        return view('productRequest.download', compact('product'));  
    }
}
