<?php

namespace App\Http\Controllers\Estore\Admin\Catalog;

use App\Enums\Catalog\ProductPackage;
use App\Enums\Catalog\ProductStatus;
use App\Enums\Catalog\PropertyType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Estore\Admin\Catalog\StoreProductRequest;
use App\Http\Requests\Estore\Admin\Catalog\UpdateProductRequest;
use App\Models\Estore\Catalog\Product;
use App\Models\Estore\Catalog\Property;
use App\Services\Admin\Catalog\StoreProductService;
use Exception;

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
        $product = new Product();
        return view('admin.catalog.products.create', [
            'fields' => $this->getFormFields($product),
            'properties' => $this->getFormProperties($product)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request, StoreProductService $service)
    {
        try {
            $product = $service->store($request);
            if ($request->has('apply')) {
                return redirect()->route('admin.catalog.products.edit', $product->id)->with('success', 'Product has ben created');
            } else {
                return redirect()->route('admin.catalog.products.index')->with('success', 'Product has ben created');
            }
        } catch (Exception $e) {
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
        return redirect()->route('admin.catalog.products.edit', $product->id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.catalog.products.edit', [
            'product' => $product,
            'fields' => $this->getFormFields($product),
            'properties' => $this->getFormProperties($product)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product, StoreProductService $service)
    {
        try {
            $service->update($product, $request);
            if ($request->has('apply')) {
                return redirect()->route('admin.catalog.products.edit', $product->id)->with('success', 'Product has ben created');
            } else {
                return redirect()->route('admin.catalog.products.index')->with('success', 'Product has ben created');
            }
        } catch (Exception $e) {
            return redirect()->route('admin.catalog.products.create')
                ->withInput()
                ->withErrors(['storing_error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, StoreProductService $service)
    {
        $service->delete($product);
        return redirect()->route('admin.catalog.products.index')->with('success', 'Product has ben deleted');
    }

    private function getFormFields(Product $product): array
    {
        $statuses = [];
        foreach (ProductStatus::cases() as $status) {
            $statuses[] = [
                'value' => $status->value,
                'title' => $status->name,
                'selected' => (old('sku') ?? $product->status) == $status->value
            ];
        }
        $packages = [];
        foreach (ProductPackage::cases() as $package) {
            $packages[] = [
                'value' => $package->value,
                'title' => $package->name,
                'selected' => (old('sku') ?? $product->package) == $package->value
            ];
        }

        return [
            ['type' => PropertyType::FILE, 'label' => 'Images', 'name' => 'images', 'multiple' => true, 'values' => []],
            ['type' => PropertyType::STRING, 'label' => 'Sort', 'name' => 'sort', 'value' => old('sort') ?? $product->sort ?? ''],
            ['type' => PropertyType::ENUM, 'label' => 'Status', 'name' => 'status', 'options' => $statuses],
            ['type' => PropertyType::STRING, 'label' => 'SKU', 'name' => 'sku', 'value' => old('sku') ?? $product->sku ?? ''],
            ['type' => PropertyType::STRING, 'label' => 'Name', 'name' => 'name', 'value' => old('name') ?? $product->name ?? ''],
            ['type' => PropertyType::STRING, 'label' => 'Slug', 'name' => 'slug', 'value' => old('slug') ?? $product->slug ?? ''],
            ['type' => PropertyType::FLOAT, 'label' => 'Purchasing price', 'name' => 'purchasing_price', 'value' => old('purchasing_price') ?? $product->purchasing_price ?? ''],
            ['type' => PropertyType::FLOAT, 'label' => 'Base price', 'name' => 'base_price', 'value' => old('base_price') ?? $product->base_price ?? ''],
            ['type' => PropertyType::FLOAT, 'label' => 'Discount price', 'name' => 'discount_price', 'value' => old('discount_price') ?? $product->discount_price ?? ''],
            ['type' => PropertyType::NUMBER, 'label' => 'Width', 'name' => 'width', 'value' => old('width') ?? $product->width ?? ''],
            ['type' => PropertyType::NUMBER, 'label' => 'Height', 'name' => 'height', 'value' => old('height') ?? $product->height ?? ''],
            ['type' => PropertyType::NUMBER, 'label' => 'Length', 'name' => 'length', 'value' => old('length') ?? $product->length ?? ''],
            ['type' => PropertyType::NUMBER, 'label' => 'Weight', 'name' => 'weight', 'value' => old('weight') ?? $product->weight ?? ''],
            ['type' => PropertyType::ENUM, 'label' => 'Package', 'name' => 'package', 'options' => $packages],
            ['type' => PropertyType::TEXT, 'label' => 'Description', 'name' => 'description', 'value' => old('description') ?? $product->description ?? ''],
        ];
    }

    private function getFormProperties(Product $product): array
    {
        $fields = [];

        $properties = Property::all();
        foreach ($properties as $property) {
            $fieldName = 'properties[' . $property->id . ']';
            $field = [
                'type' => $property->type,
                'label' => $property->name,
                'name' => $fieldName,
                'multiple' => $property->multiple
            ];

            if ($property->multiple) {
                $values = [];
                $productPropertyValues = $product->propertyValues()->where('property_id', $property->id)->get();
                if ($productPropertyValues) {
                    foreach ($productPropertyValues as $productPropertyValue) {
                        $values[$productPropertyValue->id] = $productPropertyValue->value;
                    }
                }
                $oldValues = old('properties.' . $property->id);
                if (!empty($oldValues)) {
                    foreach (old('properties.' . $property->id) as $id => $value) {
                        if (!empty($value)) {
                            $values[$id] = $value;
                        }
                    }
                }

                if ($property->type == PropertyType::ENUM) {
                    $field['options'] = [];
                    foreach ($property->enums as $enum) {
                        $field['options'][] = [
                            'value' => $enum->id,
                            'title' => $enum->name,
                            'selected' => in_array($enum->id, $values)
                        ];
                    }
                } else {
                    $field['values'] = $values;
                }
            } else {
                $productPropertyValue = $product->propertyValues()->where('property_id', $property->id)->first()?->value;
                if ($property->type == PropertyType::ENUM) {
                    $field['options'] = [];
                    foreach ($property->enums as $enum) {
                        $field['options'][] = [
                            'value' => $enum->id,
                            'title' => $enum->name,
                            'selected' => (old($fieldName) ?? $productPropertyValue) == $enum->id
                        ];
                    }
                } else {
                    $field['value'] = old($property->id) ?? $productPropertyValue ?? '';
                }
            }

            $fields[] = $field;
        }

        return $fields;
    }
}
