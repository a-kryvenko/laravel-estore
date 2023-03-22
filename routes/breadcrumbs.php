<?php

use App\Models\Estore\Catalog\Section;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('admin.dashboard'));
});
Breadcrumbs::for('admin.catalog.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Catalog', route('admin.catalog.index'));
});

Breadcrumbs::for('admin.catalog.products.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.catalog.index');
    $trail->push('Products', route('admin.catalog.products.index'));
});
Breadcrumbs::for('admin.catalog.products.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.catalog.products.index');
    $trail->push('Create product');
});
Breadcrumbs::for('admin.catalog.products.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.catalog.products.index');
    $trail->push('Edit product');
});

Breadcrumbs::for('admin.catalog.properties.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.catalog.index');
    $trail->push('Properties', route('admin.catalog.properties.index'));
});
Breadcrumbs::for('admin.catalog.properties.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.catalog.properties.index');
    $trail->push('Create property');
});
Breadcrumbs::for('admin.catalog.properties.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.catalog.properties.index');
    $trail->push('Edit property');
});
