<?php

namespace App\Services\Admin\Catalog;

use App\Models\Estore\Catalog\Property;
use App\Models\Estore\Catalog\PropertyEnum;

class StorePropertyEnumService
{
    public function store(int $propertyId, array $enumFields): int
    {
        $id = !empty($enumFields['id']) ? $enumFields['id'] : 0;
        unset($enumFields['id']);

        if (!$id) {
            $enumFields['property_id'] = $propertyId;
            $enum = PropertyEnum::create($enumFields);
        } else {
            $enum = PropertyEnum::findOrFail($id);
            $enum->fill($enumFields)->save();
        }

        return $enum->id;
    }

    public function sync(Property $property, array $enumIds): void
    {
        PropertyEnum::where('property_id', $property->id)
            ->whereNotIn('id', $enumIds)
            ->delete();
    }
}
