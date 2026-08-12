<?php

use App\Support\SiteTexts;

if (! function_exists('site_text')) {
    /**
     * Ambil teks halaman yang dapat diubah dari panel admin.
     * Jatuh ke nilai default bila belum diisi.
     */
    function site_text(string $key): string
    {
        return SiteTexts::get($key);
    }
}
