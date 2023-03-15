<?php

namespace App\Http\Controllers\Estore\Admin\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Estore\Admin\Catalog\StorePropertyRequest;
use App\Http\Requests\Estore\Admin\Catalog\UpdatePropertyRequest;
use App\Models\Estore\Catalog\Property;
use App\Services\Admin\Catalog\StorePropertyService;
use Exception;

class AdminPropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Property::latest()->get();
        return view('admin.catalog.properties.index', [
            'properties' => $properties
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.catalog.properties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropertyRequest $request, StorePropertyService $service)
    {
        try {
            $property = $service->store($request);

            if ($request->has('apply')) {
                return redirect()->route('admin.catalog.properties.edit', $property->id)->with('success', 'Property has ben created');
            } else {
                return redirect()->route('admin.catalog.properties.index')->with('success', 'Property has ben created');
            }

        } catch (Exception $e) {
            return redirect()->route('admin.catalog.properties.create')
                ->withInput()
                ->withErrors(['storing_error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        return redirect()->route('admin.catalog.properties.edit', $property->id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        return view('admin.catalog.properties.edit', ['property' => $property]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyRequest $request, Property $property, StorePropertyService $service)
    {
        try {
            $service->update($request, $property);

            if ($request->has('apply')) {
                return redirect()->route('admin.catalog.properties.edit', $property->id)->with('success', 'Property has ben updated');
            } else {
                return redirect()->route('admin.catalog.properties.index')->with('success', 'Property has ben updated');
            }

        } catch (Exception $e) {
            return redirect()->route('admin.catalog.properties.edit', $property->id)
                ->withInput()
                ->withErrors(['storing_error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property, StorePropertyService $service)
    {
        $service->delete($property);
        return redirect()->route('admin.catalog.properties.index')->with('success', 'Property has ben deleted');
    }
}
