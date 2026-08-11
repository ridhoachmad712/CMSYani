<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    public const CACHE_KEY = 'site_setting';

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
        'profile_photo',
        'profile_photo_size',
        'profile_photo_position',
        'hero_bg_color',
        'hero_bg_image',
        'logo_height',
    ];

    protected function casts(): array
    {
        return [
            'logo_height' => 'integer',
        ];
    }

    /**
     * Ambil satu-satunya baris pengaturan situs (single-record).
     * Membuat baris kosong bila belum ada agar pemanggil selalu dapat objek.
     */
    public static function current(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }

    /**
     * Versi ter-cache untuk dipakai di sisi publik (jarang berubah).
     * Cache di-clear otomatis saat model disimpan/dihapus (lihat booted()).
     */
    public static function cached(): self
    {
        return Cache::remember(self::CACHE_KEY, now()->addHours(6), fn () => static::current());
    }

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget(self::CACHE_KEY));
        static::deleted(fn () => Cache::forget(self::CACHE_KEY));
    }
}
