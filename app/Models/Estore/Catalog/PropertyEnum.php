<?php

namespace App\Models\Estore\Catalog;

use App\Traits\HasUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\MediaCollections\Models\Concerns\HasUuid;

class PropertyEnum extends Model
{
    use HasFactory, HasUuid, HasUpdatedBy;

    protected $guarded = [
        'uuid',
        'updated_by'
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function setPropertyIdAttribute($value)
    {
        if ($this->property_id) {
            return;
        }
        $this->attributes['property_id'] = $value;
    }

    public function uniqueIds()
    {
        return ['uuid'];
    }
}
