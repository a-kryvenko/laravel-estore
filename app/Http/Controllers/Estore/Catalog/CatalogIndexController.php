<?php

namespace App\Http\Controllers\Estore\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Estore\Catalog\Section;

class CatalogIndexController extends Controller
{
    public function index()
    {
        $sections = Section::where('parent_section_id', false)->get();
        return view('estore.catalog.index', [
            'sections' => $sections
        ]);
    }
}
