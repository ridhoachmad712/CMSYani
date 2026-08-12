<?php

namespace App\Models;

use App\Support\SiteTexts;
use Illuminate\Database\Eloquent\Model;

class SiteText extends Model
{
    protected $fillable = ['key', 'value'];

    protected static function booted(): void
    {
        static::saved(fn () => SiteTexts::forget());
        static::deleted(fn () => SiteTexts::forget());
    }
}
