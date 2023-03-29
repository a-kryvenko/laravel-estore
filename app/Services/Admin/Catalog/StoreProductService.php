<?php

namespace App\Services\Admin\Catalog;

use App\Http\Requests\Estore\Admin\Catalog\StoreProductRequest;
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
            $this->setDataFromRequest($product, $request);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $product;
    }

    /**
     * @param Product $product
     * @param StoreProductRequest $request
     * @return void
     * @throws Exception
     */
    public function update(Product $product, StoreProductRequest $request)
    {
        try {
            DB::beginTransaction();

            $product->update($request->safe()->except(['properties', 'sections', 'images']));
            $this->setDataFromRequest($product, $request);

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
        StoreProductRequest $request
    ): void
    {
        $this->setProperties($product, $request);
        $this->setImages($product, $request);
        $this->setSections($product, $request);

        $product->save();
    }

    private function setProperties(Product $product, StoreProductRequest $request): void
    {
        $properties = $request->safe()->only('properties');
        $properties = $properties['properties'] ?? [];

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

    private function setImages(Product $product, StoreProductRequest $request): void
    {
        if ($request->images) {
            $product->addMultipleMediaFromRequest(['images'])
                ->each(function($fileAdder) {
                    $fileAdder->toMediaCollection('images');
                });
        }

        $removedImages = $request->safe()->only('imagesRemoved');
        $removedImages = $removedImages['imagesRemoved'] ?? [];

        foreach ($removedImages as $mediaId) {
            if (intval($mediaId) > 0) {
                $product->deleteMedia($mediaId);
            }
        }
    }

    private function setSections(Product $product, StoreProductRequest $request): void
    {
        $sections = $request->safe()->only('sections');
        $sections = $sections['sections'] ?? [];

        $primarySection = $request->canonicalSectionId ?? false;

        $product->sections()->detach();
        $product->sections()->attach($sections ?: [], ['primary' => false]);

        if ($primarySection) {
            $product->sections()->updateExistingPivot($primarySection, ['primary' => true]);
        }
    }
}
