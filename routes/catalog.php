<?php

use App\Http\Controllers\Estore\Catalog\CatalogIndexController;
use Illuminate\Support\Facades\Route;

Route::get('catalog', [CatalogIndexController::class, 'index']);
