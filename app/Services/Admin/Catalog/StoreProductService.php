<?php

namespace App\Services\Admin\Catalog;

use App\Http\Requests\Estore\Admin\Catalog\StoreProductRequest;
use App\Http\Requests\Estore\Admin\Catalog\UpdateProductRequest;
use App\Models\Estore\Catalog\Product;
use Exception;
use Illuminate\Support\Facades\DB;

class StoreProductService
{
    public function store(StoreProductRequest $request): Product
    {
        return Product::create($request->validated());
    }

    public function update(Product $product, UpdateProductRequest $request)
    {

    }

    /**
     * @param Product $product
     * @return void
     * @throws Exception
     */
    public function delete(Product $product): void
    {
        try {
            DB::beginTransaction();

            $product->delete();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
