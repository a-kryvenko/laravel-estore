<?php

namespace App\Services\Admin\Catalog;

use App\Http\Requests\Estore\Admin\Catalog\StoreProductRequest;
use App\Http\Requests\Estore\Admin\Catalog\UpdateProductRequest;
use App\Models\Estore\Catalog\Product;
use Exception;
use Illuminate\Support\Facades\DB;

class StoreProductService
{
    /**
     * @param StoreProductRequest $request
     * @return Product
     * @throws Exception
     */
    public function store(StoreProductRequest $request): Product
    {
        try {
            DB::beginTransaction();

            $product = Product::create($request->safe()->except(['properties', 'sections']));

            $propertiesRequest = $request->safe()->only('properties');
            foreach ($propertiesRequest['properties'] as $propertyId => $propertyValues) {
                foreach ($propertyValues as $value) {
                    $product->properties()->attach($propertyId, ['value' => $value]);
                }
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $product;
    }

    /**
     * @param Product $product
     * @param UpdateProductRequest $request
     * @return void
     * @throws Exception
     */
    public function update(Product $product, UpdateProductRequest $request)
    {
        try {
            DB::beginTransaction();

            $product->update($request->safe()->except(['properties', 'sections']));

            $product->properties()->detach();

            $propertiesRequest = $request->safe()->only('properties');
            foreach ($propertiesRequest['properties'] as $propertyId => $propertyValues) {
                foreach ($propertyValues as $value) {
                    $product->properties()->attach($propertyId, ['value' => $value]);
                }
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
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
