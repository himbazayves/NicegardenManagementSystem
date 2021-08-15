<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductList;
use App\ProductCategory;
use App\ProductMeasurement;

class ProductListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = ProductList::paginate(25);

        return view('inventory.products_list.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::all();
        $measurements = ProductMeasurement::all();

        return view('inventory.products_list.create',["categories"=>$categories,"measurements"=>$measurements ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $request->validate([

        'name'=>'required',
        'product_measurement_id'=>"required",
        'product_category_id'=>'required',
        'price'=>'required',

        ]);

        $product = New ProductList;
        $product->name=$request->name;
        $product->product_mesaurement_id=$request->product_measurement_id;
        $product->product_category_id=$request->product_category_id;
        $product->price=$request->price;
        $product->save();


        return redirect()
            ->route('productsList.index')
            ->withStatus('Product successfully registered.');
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
        $categories = ProductCategory::all();
        $product =ProductList::find($id);
        $measurements = ProductMesaurement::all();

        return view('inventory.products_list.edit', compact('product', 'categories','measurements'));
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
        $request->validate([

            'name'=>'required',
            'product_measurement_id'=>"required",
            'product_category_id'=>'required',
            'price'=>'required',
    
            ]);
    
            $product =ProductList::find($id);
            $product->name=$request->name;
            $product->product_mesaurement_id=$request->product_measurement_id;
            $product->product_category_id=$request->product_category_id;
            $product->price=$request->price;
            $product->save();
    
    
            return redirect()
                ->route('productsList.index')
                ->withStatus('Product successfully registered.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {  
        $product=ProductList::find($id);
        $product->delete();

        return redirect()
            ->route('productsList.index')
            ->withStatus('Product removed successfully.');
    }
}
