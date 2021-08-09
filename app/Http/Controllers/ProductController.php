<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use App\ProductList;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(25);

        return view('inventory.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $categories = ProductCategory::all();
        $produtLists= ProductList::all();

        return view('inventory.products.create', compact('produtLists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ProductRequest  $request
     * @param  App\Product  $model
     * @return \Illuminate\Http\Response
     */
    // public function store(ProductRequest $request, Product $model)
    public function store(Request $request)
    {
        // $model->create($request->all());

        $request->validate([
         'product'=>'required',
         'stock'=>'required',
         'stock_defective'=>"required",
        ]);

        $productType=ProductList::find($request->product);
        $product = new Product;
        $product->stock=$request->stock;
        $product->description=$request->description;
        $product->stock_defective=$request->stock_defective;
        $product->price=$productType->price;
        $product->name=$productType->name;
        $product->product_category_id=$productType->product_category_id;
        $product->save();


        return redirect()
            ->route('products.index')
            ->withStatus('Product successfully registered.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $solds = $product->solds()->latest()->limit(25)->get();

        $receiveds = $product->receiveds()->latest()->limit(25)->get();

        return view('inventory.products.show', compact('product', 'solds', 'receiveds'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $produtLists= ProductList::all();

        return view('inventory.products.edit', compact('produtLists', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {   
        // if($request->topUp !=""){
        //  $updatedStock=$product->stock + $request->topUp;
        //  $product->stock=$updatedStock;
        //  $product->save();
        //  return redirect()
        //     ->route('products.index')
        //     ->withStatus('Product stock toped up successfully.');
        // }
        $product->update($request->all());

        return redirect()
            ->route('products.index')
            ->withStatus('Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->withStatus('Product removed successfully.');
    }



    public function topUp($id)
    {
        $product=Product::find($id);
     

        return view('inventory.products.topUp', compact('product'));
    }

    public function topUpInsert(Request $request, $id){
        $request->validate([
            "stock"=>"required"
        ]);
        $product=Product::find($id);
        $updatedStock=$product->stock + $request->stock;
        $product->stock=$updatedStock;
        $product->save();
        return redirect()
           ->route('products.index')
           ->withStatus('Product stock toped up successfully.');
    }
}
