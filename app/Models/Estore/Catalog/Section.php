<?php

namespace App\Models\Estore\Catalog;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Spatie\MediaLibrary\MediaCollections\Models\Concerns\HasUuid;

class Section extends Model
{
    use HasFactory, HasUuid;

    protected $guarded = [
        'uuid'
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'parent_section_id');
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class, 'parent_section_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(ProductSection::class);
    }

    public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function uniqueIds()
    {
        return ['uuid'];
    }

    protected static function booted()
    {
        static::deleted(function (Section $section) {
            $section->products()->detach();
            $section->sections()->delete();
        });
    }
}
