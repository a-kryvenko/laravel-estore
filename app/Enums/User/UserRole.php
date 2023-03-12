<?php

namespace App\Enums\User;

enum UserRole
{
    case ADMINISTRATOR;
    case DEVELOPER;
    case CONTENT_MANAGER;
    case SALES_MANAGER;
    case ANALYTIC;
    case STAKEHOLDER;

    public function name(): string
    {
        return match($this) {
            UserRole::ADMINISTRATOR => __('enums.user_role.administrator'),
            UserRole::DEVELOPER => __('enums.user_role.developer'),
            UserRole::CONTENT_MANAGER => __('enums.user_role.content_manager'),
            UserRole::SALES_MANAGER => __('enums.user_role.sales_manager'),
            UserRole::ANALYTIC => __('enums.user_role.sales_analytic'),
            UserRole::STAKEHOLDER => __('enums.user_role.stakeholder')
        };
    }
}
