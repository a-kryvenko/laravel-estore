<?php

namespace App\Enums\Catalog;

enum PropertyType: string
{
    case BOOLEAN = 'B';
    case STRING = 'S';
    case NUMBER = 'N';
    case FLOAT = 'F';
    case ENUM = 'E';
    case COLOR = 'C';

    case TEXT = 'T';
}
