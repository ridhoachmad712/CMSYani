<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'tagline',
        'hero_subtitle',
        'about_text',
        'quote_text',
        'email',
        'phone_primary',
        'phone_secondary',
        'address',
        'instagram_url',
        'whatsapp_number',
        'logo_path',
    ];

    /**
     * Ambil satu-satunya baris pengaturan situs (single-record).
     * Membuat baris kosong bila belum ada agar pemanggil selalu dapat objek.
     */
    public static function current(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
