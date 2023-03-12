<?php

namespace App\Models\Estore\Catalog;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\MediaCollections\Models\Concerns\HasUuid;

class Property extends Model
{
    use HasFactory, HasUuid;

    protected $guarded = [
        'updated_by'
    ];

    public function enums(): HasMany
    {
        return $this->hasMany(PropertyEnum::class);
    }

    public function productsValues(): HasMany
    {
        return $this->hasMany(ProductPropertyValue::class);
    }

    public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }


    protected static function booted(): void
    {
        static::deleted(function (Property $property) {
            $property->enums()->delete();
            $property->productsValues()->delete();
        });
    }
}
