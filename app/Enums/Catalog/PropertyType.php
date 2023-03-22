<?php

namespace App\Enums\Catalog;

use Illuminate\Support\Str;

enum PropertyType: string
{
    case BOOLEAN = 'B';
    case STRING = 'S';
    case NUMBER = 'N';
    case FLOAT = 'F';
    case ENUM = 'E';
    case COLOR = 'C';

    case TEXT = 'T';
    case FILE = 'FI';

    function title()
    {
        return Str::ucfirst(Str::lower($this->name));
    }
}
