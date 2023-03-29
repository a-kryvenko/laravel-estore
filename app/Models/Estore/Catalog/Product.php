<?php

namespace App\Models\Estore\Catalog;

use App\Enums\Catalog\ProductStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Concerns\HasUuid;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasUuid;

    protected $guarded = [
        'uuid',
        'available'
    ];

    protected $casts = [
        'status' => ProductStatus::class
    ];

    protected $attributes = [
        'sort' => 100,
        'views_count' => 0
    ];

    public function canonicalSection(): HasOneThrough
    {
        return $this->hasOneThrough(
            Section::class,
            ProductSection::class,
            'product_id',
            'id',
            'id',
            'section_id'
        );
    }

    public function sections(): BelongsToMany
    {
        return $this->belongsToMany(Section::class);
    }

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class)
            ->using(ProductPropertyValue::class)
            ->as('property_values')
            ->withPivot('value');
    }

    public function propertyValues(): HasMany
    {
        return $this->hasMany(ProductPropertyValue::class);
    }

    public function warehouses(): BelongsToMany
    {
        return $this->belongsToMany(Warehouse::class)
            ->as('storage')
            ->withPivot('quantity');
    }

    protected static function booted(): void
    {
        static::deleted(function (Product $product) {
            ProductPropertyValue::where('product_id', $product->id)->delete();
            ProductSection::where('product_id', $product->id)->delete();
        });
    }

    public function uniqueIds()
    {
        return ['uuid'];
    }
}
