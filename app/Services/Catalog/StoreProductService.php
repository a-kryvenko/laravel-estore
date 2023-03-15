<?php

namespace App\Services\Catalog;

use App\Http\Requests\Estore\Admin\Catalog\StoreProductRequest;
use App\Models\Estore\Catalog\Product;

class StoreProductService
{
    public function store(StoreProductRequest $request)
    {
        Product::create($request->validated());
    }
}
