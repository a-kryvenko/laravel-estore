<?php

namespace App\Http\Controllers\Estore\Admin\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Estore\Admin\Catalog\StoreProductRequest;
use App\Http\Requests\Estore\Admin\Catalog\UpdateProductRequest;
use App\Models\Estore\Catalog\Product;
use App\Services\Admin\Catalog\StoreProductService;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.catalog.products.index', [
            'products' => Product::orderBy('id')->paginate(25),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.catalog.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request, StoreProductService $service)
    {
        if (!$request->validated()) {
            return redirect()->route('admin.catalog.products.create')
                ->withErrors($request->validated()->errors())
                ->withInput();
        }

        try {
            $service->store($request);
            return redirect()->route('admin.catalog.products.index')->with('success', 'Product has ben created');
        } catch (\Exception $e) {
            return redirect()->route('admin.catalog.products.create')
                ->withInput()
                ->withErrors(['storing_error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
