<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterSubscriber extends Model
{
    protected $fillable = [
        'email',
        'subscribed_at',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'subscribed_at' => 'datetime',
            'is_active' => 'boolean',
        ];
    }
}
