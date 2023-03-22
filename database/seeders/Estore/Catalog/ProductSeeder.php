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
        $enumProperties = Property::factory(1)
            ->has(PropertyEnum::factory(4), 'enums')
            ->create([
                'type' => PropertyType::ENUM
            ]);

        $stringProperties = Property::factory(1)
            ->create([
                'type' => PropertyType::STRING
            ]);

        $floatProperties = Property::factory(1)
            ->create([
                'type' => PropertyType::FLOAT
            ]);

        $numberProperties = Property::factory(1)
            ->create([
                'type' => PropertyType::NUMBER
            ]);

        $enumMultipleProperties = Property::factory(1)
            ->has(PropertyEnum::factory(4), 'enums')
            ->create([
                'type' => PropertyType::ENUM,
                'multiple' => true
            ]);

        $stringMultipleProperties = Property::factory(1)
            ->create([
                'type' => PropertyType::STRING,
                'multiple' => true
            ]);

        $floatMultipleProperties = Property::factory(1)
            ->create([
                'type' => PropertyType::FLOAT,
                'multiple' => true
            ]);

        $numberMultipleProperties = Property::factory(1)
            ->create([
                'type' => PropertyType::NUMBER,
                'multiple' => true
            ]);

        // Create products
    }
}
