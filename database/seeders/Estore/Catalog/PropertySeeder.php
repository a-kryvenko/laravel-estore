<?php

namespace Database\Seeders\Estore\Catalog;

use App\Enums\Catalog\PropertyType;
use Database\Factories\Estore\Catalog\PropertyFactory;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PropertyFactory::create([
            'uuid' => uuid_create(),
            'sort' => 100,
            'active' => true,
            'name' => 'Color',
            'slug' => 'color',
            'filterable' => true,
            'type' => PropertyType::COLOR->value,
            'multiple' => false,
            'view_format' => null
        ]);
        PropertyFactory::create([
            'uuid' => uuid_create(),
            'sort' => 110,
            'active' => true,
            'name' => 'Tags',
            'slug' => 'tags',
            'filterable' => true,
            'type' => PropertyType::STRING->value,
            'multiple' => true,
            'view_format' => null
        ]);
        PropertyFactory::create([
            'uuid' => uuid_create(),
            'sort' => 110,
            'active' => true,
            'name' => 'Size',
            'slug' => 'size',
            'filterable' => true,
            'type' => PropertyType::STRING->value,
            'multiple' => true,
            'view_format' => null
        ]);
    }
}
