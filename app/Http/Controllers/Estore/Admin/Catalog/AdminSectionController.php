<?php

namespace App\Http\Controllers\Estore\Admin\Catalog;

use App\Enums\Catalog\ProductPackage;
use App\Enums\Catalog\ProductStatus;
use App\Enums\Catalog\PropertyType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Estore\Admin\Catalog\StoreSectionRequest;
use App\Http\Requests\Estore\Admin\Catalog\UpdateSectionRequest;
use App\Models\Estore\Catalog\Section;
use App\Services\Admin\Catalog\StoreSectionService;
use Exception;

class AdminSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.catalog.sections.index', [
            'sections' => Section::orderBy('name')->paginate(25)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $section = new Section();
        return view('admin.catalog.sections.create', [
            'fields' => $this->getFormFields($section)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSectionRequest $request, StoreSectionService $service)
    {
        try {
            $section = $service->store($request);
            if ($request->has('apply')) {
                return redirect()->route('admin.catalog.sections.edit', $section->id)->with('success', 'Section has ben created');
            } else {
                return redirect()->route('admin.catalog.sections.index')->with('success', 'Section has ben created');
            }
        } catch (Exception $e) {
            return back()->withInput()
                ->withErrors(['storing_error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        return redirect()->route('admin.catalog.sections.edit', $section->id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        return view('admin.catalog.sections.edit', [
            'section' => $section,
            'fields' => $this->getFormFields($section)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSectionRequest $request, Section $section, StoreSectionService $service)
    {
        try {
            $service->update($section, $request);
            if ($request->has('apply')) {
                return redirect()->route('admin.catalog.sections.edit', $section->id)->with('success', 'Section has ben created');
            } else {
                return redirect()->route('admin.catalog.sections.index')->with('success', 'Section has ben created');
            }
        } catch (Exception $e) {
            return back()->withInput()
                ->withErrors(['storing_error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section, StoreSectionService $service)
    {
        try {
            $service->delete($section);
            return redirect()->route('admin.catalog.sections.index')->with('success', 'Section has ben created');
        } catch (Exception $e) {
            return back()->withInput()
                ->withErrors(['storing_error' => $e->getMessage()]);
        }
    }

    private function getFormFields(Section $section): array
    {
        return [
            ['type' => PropertyType::BOOLEAN, 'label' => 'Active', 'name' => 'active', 'value' => boolval(old('active') ?? $section->active ?? '')],
            ['type' => PropertyType::STRING, 'label' => 'Sort', 'name' => 'sort', 'value' => old('sort') ?? $section->sort ?? ''],
            ['type' => PropertyType::STRING, 'label' => 'Name', 'name' => 'name', 'value' => old('name') ?? $section->name ?? ''],
            ['type' => PropertyType::STRING, 'label' => 'Slug', 'name' => 'slug', 'value' => old('slug') ?? $section->slug ?? ''],
//            ['type' => PropertyType::STRING, 'label' => 'Parent section', 'name' => 'parent_section_id', 'value' => old('parent_section_id') ?? $section->parent_section_id ?? ''],
            ['type' => PropertyType::TEXT, 'label' => 'Description', 'name' => 'description', 'value' => old('description') ?? $section->description ?? ''],
        ];
    }
}
