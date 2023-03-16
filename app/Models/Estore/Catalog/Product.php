<?php

namespace App\Models\Estore\Catalog;

use App\Enums\Catalog\ProductStatus;
use App\Traits\HasUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Concerns\HasUuid;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasUuid, HasUpdatedBy;

    protected $guarded = [
        'uuid',
        'updated_by',
        'available'
    ];

    protected $casts = [
        'status' => ProductStatus::class
    ];

    protected $attributes = [
        'sort' => 100,
        'views_count' => 0
    ];

    public function canonicalSection(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'canonical_section_id');
    }

    public function sections(): BelongsToMany
    {
        return $this->belongsToMany(Section::class);
    }

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class, 'product_property_values')
            ->as('property_values')
            ->withPivot('value');
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
