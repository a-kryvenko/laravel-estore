<?php

namespace App\Models\Estore\Catalog;

use App\Enums\Catalog\ProductStatus;
use App\Models\User;
use App\Traits\HasUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Concerns\HasUuid;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasUuid, HasUpdatedBy;

    protected $guarded = [
        'uuid',
        'updated_by'
    ];

    protected $casts = [
        'status' => ProductStatus::class
    ];

    public function canonicalSection(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'canonical_section_id');
    }

    public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function uniqueIds()
    {
        return ['uuid'];
    }
}
