<?php

use App\Models\Estore\Catalog\Section;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('admin.dashboard'));
});
Breadcrumbs::for('admin.catalog', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Catalog', route('admin.catalog.list'));
});
Breadcrumbs::for('admin.catalog.products', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.catalog');
    $trail->push('Products', route('admin.catalog.products.index'));
});
Breadcrumbs::for('admin.catalog.products.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.catalog.products');
    $trail->push('Create product');
});
Breadcrumbs::for('admin.catalog.products.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.catalog.products');
    $trail->push('Edit product');
});
