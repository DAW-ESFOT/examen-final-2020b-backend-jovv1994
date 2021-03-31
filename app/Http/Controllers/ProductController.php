<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Product;
use App\Http\Resources\Product as ProductResource;
use App\Http\Resources\ProductCollection;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function index(Customer $customer)
    {
        return response()->json(ProductResource::collection($customer->products()), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Customer $customer
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer, Product $product)
    {
        $product = $customer->products()->where('id', $product->id)->firstOrFail();
        return response()->json(new ProductResource($product), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Customer $customer)
    {
        //VALIDACIONES
        $validatedData = $request->validate([
            'name' => 'required|string',
            'code' => 'string|max:10',
            //'price' => 'double',
        ]);

        $product = $customer->products()->save(new Product($request->all()));
        return response()->json(new ProductResource($product), 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function delete(Product $product)
    {
        $product->status = 'deleted';
        $product->update($product->all());
        return response()->json($product, 200);
    }
}
