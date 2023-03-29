<?php

use App\Models\Estore\Catalog\Section;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('admin.dashboard'));
});

Breadcrumbs::for('admin.catalog.dashboard', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Catalog', route('admin.dashboard'));
});
Breadcrumbs::for('admin.catalog.list', function (BreadcrumbTrail $trail, ?Section $section = null) {
    if ($section) {
        $trail->parent('admin.catalog.list', $section->parent);
        $trail->push($section->name, route('admin.catalog.list', $section->id));
    } else {
        $trail->parent('admin.dashboard');
        $trail->push('Catalog', route('admin.catalog.list'));
    }
});

// Breadcrumbs for admin products list
Breadcrumbs::for('admin.catalog.products.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.catalog.dashboard');
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

// Breadcrumbs for admin properties list
Breadcrumbs::for('admin.catalog.properties.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.catalog.dashboard');
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

// Breadcrumbs for admin sections list
Breadcrumbs::for('admin.catalog.sections.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.catalog.dashboard');
    $trail->push('Sections', route('admin.catalog.sections.index'));
});
Breadcrumbs::for('admin.catalog.sections.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.catalog.sections.index');
    $trail->push('Create section');
});
Breadcrumbs::for('admin.catalog.sections.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.catalog.sections.index');
    $trail->push('Edit section');
});
