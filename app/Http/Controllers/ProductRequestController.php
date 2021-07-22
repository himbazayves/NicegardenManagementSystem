<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;


use App\ProductRequest;
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
        $productRequests = productRequest::latest()->paginate(2);

        return view('productRequest.index', compact('productRequests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        
         return view('productRequest.create');
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
            'description'=> 'required',
            'title'=> 'required',
            'requestTo'=>'required',
            'person'=>'required',
        ]);
   
        $requestProduct= new ProductRequest;
        if($request->requestTo=="chef"){
            $requestProduct->chef_id=find::User($request->person)->userable->id;
            }
    
            elseif($request->requestTo=="waiter"){
             $requestProduct->waiter_id=User::find($request->person)->userable->id;

                
    
            }
            elseif($request->requestTo=="stockManager"){
                $requestProduct->stock_manager_id=User::find($request->person)->userable->id;
    
            }
            elseif($request->requestTo=="restoChef"){
                $requestProduct->resto_chef_id=User::find($request->person)->userable->id;
    
            }
    
            elseif($request->requestTo=="houseKeeper"){
                $requestProduct->house_keeper_id=User::find($request->person)->userable->id;
    
            }
            elseif($request->requestTo=="waiter"){
                $requestProduct->waiter_id=User::find($request->person)->userable->id;
    
            }
    
            else{
                $requestProduct->accountant_id=User::find($request->person)->userable->id;
    
            }
            $requestProduct->description=$request->description;
            $requestProduct->title=$request->title;
            $requestProduct->reference=$request->reference;
            $requestProduct->description=$request->description;
            $requestProduct->user_id=Auth::user()->id;
            $requestProduct->save();

            return redirect()->route('requests.index')->withStatus('Your request submitted successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function destroy($id)
    {
        //
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
}
