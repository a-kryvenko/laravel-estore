<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait HasUpdatedBy
{
    public static function bootHasUpdatedBy()
    {
        static::saving(function (Model $model) {
            $model->updated_by = Auth::id() ?: null;
        });
    }
}
