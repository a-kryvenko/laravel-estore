<?php

namespace App\Enums\Catalog;

enum ProductStatus: string
{
    case ACTIVE = 'A';
    case INACTIVE = 'I';
    case HIDDEN = 'H';
    case DELETED = 'D';
}
