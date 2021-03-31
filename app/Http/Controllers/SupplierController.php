<?php

namespace App\Http\Controllers;

use App\Supplier;
use App\Http\Resources\Supplier as SupplierResource;
use App\Http\Resources\SupplierCollection;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new SupplierCollection(Supplier::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //VALIDACIONES
        $validatedData = $request->validate([
            'name' => 'required|string',
        ]);

        $supplier = Supplier::create($request->all());
        return response()->json($supplier, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Supplier $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        return response()->json(new SupplierResource($supplier), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Supplier $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $supplier->update($request->all());
        return response()->json($supplier, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Supplier $customer
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function delete(Supplier $supplier)
    {
        $supplier->delete();
        return response()->json(null, 204);
    }
}
