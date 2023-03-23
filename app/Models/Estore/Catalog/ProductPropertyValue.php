<?php

namespace App\Models\Estore\Catalog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductPropertyValue extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'value',
        'product_id',
        'property_id'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
