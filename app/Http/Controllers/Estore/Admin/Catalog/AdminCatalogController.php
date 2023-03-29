<?php

namespace App\Http\Controllers\Estore\Admin\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Estore\Catalog\Product;
use App\Models\Estore\Catalog\Section;

class AdminCatalogController extends Controller
{
    public function index(?Section $section = null)
    {
        $sections = Section::where('parent_section_id', $section?->id ?? false)->get();
        if ($section) {
            $products = $section->products()->paginate(25);
        } else {
            $products = Product::doesntHave('sections')->paginate(25);
        }

        return view('admin.catalog.list', [
            'section' => $section,
            'sections' => $sections,
            'products' => $products
        ]);
    }
}
