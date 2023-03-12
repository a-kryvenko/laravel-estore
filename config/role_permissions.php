<?php

use App\Enums\User\UserPermission;
use App\Enums\User\UserRole;

return [
    UserRole::DEVELOPER->name => [
        UserPermission::VIEW_ADMIN_AREA,
        UserPermission::VIEW_CATALOG,
        UserPermission::VIEW_SALES,
        UserPermission::VIEW_USERS,
        UserPermission::VIEW_DISCOUNTS,
        UserPermission::EDIT_CATALOG,
        UserPermission::EDIT_SALES,
        UserPermission::EDIT_USERS,
        UserPermission::EDIT_DISCOUNTS,
        UserPermission::EDIT_CATALOG_SETTINGS,
        UserPermission::EDIT_SALE_SETTINGS,
        UserPermission::EDIT_WEBSITE_SETTINGS
    ],
    UserRole::ADMINISTRATOR->name => [
        UserPermission::VIEW_ADMIN_AREA,
        UserPermission::VIEW_CATALOG,
        UserPermission::VIEW_SALES,
        UserPermission::VIEW_USERS,
        UserPermission::VIEW_DISCOUNTS,
        UserPermission::EDIT_CATALOG,
        UserPermission::EDIT_SALES,
        UserPermission::EDIT_USERS,
        UserPermission::EDIT_DISCOUNTS,
        UserPermission::EDIT_CATALOG_SETTINGS,
        UserPermission::EDIT_SALE_SETTINGS
    ],
    UserRole::CONTENT_MANAGER->name => [
        UserPermission::VIEW_ADMIN_AREA,
        UserPermission::VIEW_CATALOG,
        UserPermission::EDIT_CATALOG
    ],
    UserRole::SALES_MANAGER->name => [
        UserPermission::VIEW_ADMIN_AREA,
        UserPermission::VIEW_CATALOG,
        UserPermission::VIEW_SALES,
        UserPermission::VIEW_USERS,
        UserPermission::VIEW_DISCOUNTS,
        UserPermission::EDIT_CATALOG,
        UserPermission::EDIT_SALES,
        UserPermission::EDIT_USERS,
        UserPermission::EDIT_DISCOUNTS
    ],
    UserRole::ANALYTIC->name => [
        UserPermission::VIEW_ADMIN_AREA,
        UserPermission::VIEW_CATALOG,
        UserPermission::VIEW_SALES,
        UserPermission::VIEW_USERS,
        UserPermission::VIEW_DISCOUNTS
    ],
    UserRole::STAKEHOLDER->name => [
        UserPermission::VIEW_ADMIN_AREA,
        UserPermission::VIEW_CATALOG,
        UserPermission::VIEW_SALES,
        UserPermission::VIEW_USERS,
        UserPermission::VIEW_DISCOUNTS
    ]
];
