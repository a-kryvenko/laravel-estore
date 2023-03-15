<?php

namespace App\Services\Admin\Catalog;

use App\Enums\Catalog\PropertyType;
use App\Http\Requests\Estore\Admin\Catalog\StorePropertyRequest;
use App\Http\Requests\Estore\Admin\Catalog\UpdatePropertyRequest;
use App\Models\Estore\Catalog\Property;
use Exception;
use Illuminate\Support\Facades\DB;

class StorePropertyService
{
    private StorePropertyEnumService $storePropertyEnumService;

    /**
     * @param StorePropertyEnumService $storePropertyEnumService
     */
    public function __construct(StorePropertyEnumService $storePropertyEnumService)
    {
        $this->storePropertyEnumService = $storePropertyEnumService;
    }

    /**
     * @param StorePropertyRequest $request
     * @return Property
     * @throws Exception
     */
    public function store(StorePropertyRequest $request): Property
    {
        try {
            DB::beginTransaction();

            $property = Property::create($request->safe()->except('enums'));

            $requestEnums = $request->safe()->only('enums');
            if (
                $property->type == PropertyType::ENUM
                && !empty($requestEnums['enums'])
            ) {
                foreach ($requestEnums['enums'] as $enumFields) {
                    $this->storePropertyEnumService->store($property->id, $enumFields);
                }
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $property;
    }

    /**
     * @param UpdatePropertyRequest $request
     * @param Property $property
     * @return void
     * @throws Exception
     */
    public function update(UpdatePropertyRequest $request, Property $property): void
    {
        try {
            DB::beginTransaction();

            $property->update($request->safe()->except('enums'));

            if ($property->type == PropertyType::ENUM) {
                $enums = [];

                $requestEnums = $request->safe()->only('enums');
                if (!empty($requestEnums['enums'])) {
                    foreach ($requestEnums['enums'] as $enumFields) {
                        $enums[] = $this->storePropertyEnumService->store($property->id, $enumFields);
                    }
                }

                $this->storePropertyEnumService->sync($property, $enums);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * @param Property $property
     * @return void
     */
    public function delete(Property $property): void
    {
        try {
            DB::beginTransaction();
            $property->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
