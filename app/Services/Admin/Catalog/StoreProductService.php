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

            $product = Product::create($request->safe()->except(['properties', 'sections', 'images']));

            $propertiesRequest = $request->safe()->only('properties');
            $imagesRequest = $request->safe()->only('images');
            $this->setDataFromRequest(
                $product,
                isset($propertiesRequest['properties']) ? $propertiesRequest['properties'] : null,
                isset($imagesRequest['images']) ? $imagesRequest['images'] : null,
                null
            );

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

            $product->update($request->safe()->except(['properties', 'sections', 'images']));
            $propertiesRequest = $request->safe()->only('properties');
            $imagesRequest = $request->safe()->only('images');
            $deleteImagesRequest = $request->safe()->only('imagesRemoved');

            $this->setDataFromRequest(
                $product,
                $propertiesRequest['properties'] ?? null,
                $imagesRequest['images'] ?? null,
                $deleteImagesRequest['imagesRemoved'] ?? null
            );

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

    private function setDataFromRequest(
        Product $product,
        ?array $properties,
        ?array $images,
        ?array $removedImagesIds
    ): void
    {
        if (!empty($properties)) {
            foreach ($properties as $propertyId => $propertyValues) {
                if (empty($propertyValues)) {
                    continue;
                }
                if (is_array($propertyValues)) {
                    foreach ($propertyValues as $value) {
                        if (!empty($value)) {
                            $product->propertyValues()->firstOrCreate(
                                ['property_id' => $propertyId],
                                ['value' => $value]
                            );
                        }
                    }
                } else {
                    $product->propertyValues()->firstOrCreate(
                        ['property_id' => $propertyId],
                        ['value' => $propertyValues]
                    );
                }
            }
        }

        if (!empty($images)) {
            $product->addMultipleMediaFromRequest(['images'])
                ->each(function($fileAdder) {
                    $fileAdder->toMediaCollection('images');
                });
        }

        if (!empty($removedImagesIds)) {
            foreach ($removedImagesIds as $mediaId) {
                if (intval($mediaId) > 0) {
                    $product->deleteMedia($mediaId);
                }
            }
        }
    }
}
