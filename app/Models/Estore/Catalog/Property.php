<?php

namespace App\Models\Estore\Catalog;

use App\Enums\Catalog\PropertyType;
use App\Models\Scopes\ActiveScope;
use App\Models\Scopes\OrderedScope;
use App\Models\User;
use App\Traits\HasUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\MediaCollections\Models\Concerns\HasUuid;

class Property extends Model
{
    use HasFactory, HasUuid, HasUpdatedBy;

    protected $guarded = [
        'uuid',
        'updated_by'
    ];

    protected $casts = [
        'type' => PropertyType::class
    ];

    public function setTypeAttribute($value)
    {
        if ($this->type) {
            return;
        }
        $this->attributes['type'] = $value;
    }

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
        static::addGlobalScope(new ActiveScope());
        static::addGlobalScope(new OrderedScope());

        static::deleted(function (Property $property) {
            $property->enums()->delete();
            $property->productsValues()->delete();
        });
    }

    public function uniqueIds()
    {
        return ['uuid'];
    }
}
