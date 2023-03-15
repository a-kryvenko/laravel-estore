<?php

use App\Http\Controllers\Estore\Admin\AdminIndexController;
use App\Http\Controllers\Estore\Admin\Catalog\AdminCatalogController;
use App\Http\Controllers\Estore\Admin\Catalog\AdminProductController;
use App\Http\Controllers\Estore\Admin\Catalog\AdminPropertyController;
use App\Http\Controllers\Estore\Admin\Catalog\AdminSectionController;
use Illuminate\Support\Facades\Route;

Route::name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [AdminIndexController::class, 'index'])->name('dashboard');

        Route::name('catalog.')
            ->prefix('catalog')
            ->group(function () {
                Route::get('/', [AdminCatalogController::class, 'index'])->name('list');

                Route::resources([
                    'properties' => AdminPropertyController::class,
                    'sections' => AdminSectionController::class,
                    'products' => AdminProductController::class
                ]);
            });
    });
