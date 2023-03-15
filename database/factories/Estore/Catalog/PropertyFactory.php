<?php

namespace Database\Factories\Estore\Catalog;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estore\Catalog\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->sentence(2);
        $slug = Str::slug($name);
        return [
            'uuid' => Str::uuid()->toString(),
            'sort' => $this->faker->numberBetween(20, 400),
            'name' => $name,
            'slug' => $slug,
            'active' => true,
            'filterable' => true,
            'multiple' => false,
            'view_format' => null
        ];
    }
}
