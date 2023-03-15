<?php

namespace App\Enums\Catalog;

use Illuminate\Support\Str;

enum ProductStatus: string
{
    case ACTIVE = 'A';
    case INACTIVE = 'I';
    case HIDDEN = 'H';
    case DELETED = 'D';

    function title()
    {
        return Str::ucfirst(Str::lower($this->name));
    }
}
