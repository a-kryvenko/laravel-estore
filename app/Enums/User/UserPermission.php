<?php

namespace App\Enums\User;

enum UserPermission
{
    case VIEW_ADMIN_AREA;
    case VIEW_CATALOG;
    case EDIT_CATALOG;
    case VIEW_SALES;
    case EDIT_SALES;
    case VIEW_DISCOUNTS;
    case EDIT_DISCOUNTS;
    case VIEW_USERS;
    case EDIT_USERS;
    case EDIT_CATALOG_SETTINGS;
    case EDIT_SALE_SETTINGS;
    case EDIT_WEBSITE_SETTINGS;
}
