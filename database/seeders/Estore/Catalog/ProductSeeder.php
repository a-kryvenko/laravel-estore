<?php

namespace Database\Seeders\Estore\Catalog;

use App\Enums\Catalog\PropertyType;
use App\Models\Estore\Catalog\Property;
use App\Models\Estore\Catalog\PropertyEnum;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $enumProperties = Property::factory(2)
            ->has(PropertyEnum::factory(4))
            ->create([
                'type' => PropertyType::ENUM
            ]);

        $stringProperties = Property::factory(2)
            ->create([
                'type' => PropertyType::STRING
            ]);

        $floatProperties = Property::factory(2)
            ->create([
                'type' => PropertyType::FLOAT
            ]);

        $numberProperties = Property::factory(2)
            ->create([
                'type' => PropertyType::NUMBER
            ]);

        // Create properties

        // Create products
    }
}
