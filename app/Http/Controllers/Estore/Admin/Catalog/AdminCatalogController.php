<?php

namespace App\Http\Controllers\Estore\Admin\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Estore\Catalog\Product;
use App\Models\Estore\Catalog\Section;
use Illuminate\Http\Request;


class AdminCatalogController extends Controller
{
    public function index(Request $request)
    {
        $sectionId = $request->get('section_id');
        $sections = Section::where('parent_section_id', false)->get();
        $products = [];

        if ($sectionId) {
            //$products = Product::where('section', false)->get();
        } else {
           // $products = Product::where('canonical_section_id', false)->get();
        }

        return view('admin.catalog.list', [
            'sections' => $sections,
            'products' => $products
        ]);
    }
}
