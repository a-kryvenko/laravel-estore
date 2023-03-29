<?php

namespace App\Models\Estore\Catalog;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Warehouse extends Model
{
    use HasFactory;

    public function products(): HasManyThrough
    {
        return $this->hasManyThrough(WarehouseProductQuantity::class, Product::class);
    }

    protected static function booted(): void
    {
        static::deleted(function (Warehouse $warehouse) {
            WarehouseProductQuantity::where('warehouse_id', $warehouse->id)->get()->delete();
        });
    }
}
