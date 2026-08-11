<?php

namespace App\Support;

/**
 * Daftar ikon Heroicon (outline) terkurasi untuk dipilih di panel admin
 * (layanan & izin). Key = nama ikon Filament, value = label ramah pengguna.
 * Bisa ditambah sesuai kebutuhan tanpa mengubah kode form.
 */
class Icons
{
    public static function options(): array
    {
        return [
            'heroicon-o-chat-bubble-left-right' => 'Konsultasi / Percakapan',
            'heroicon-o-clipboard-document-check' => 'Review / Ceklis Dokumen',
            'heroicon-o-document-text' => 'Dokumen / SPT',
            'heroicon-o-magnifying-glass-circle' => 'Pemeriksaan / Audit',
            'heroicon-o-scale' => 'Hukum / Keadilan',
            'heroicon-o-banknotes' => 'Restitusi / Keuangan',
            'heroicon-o-identification' => 'Izin / Identitas',
            'heroicon-o-building-library' => 'Kepabeanan / Institusi',
            'heroicon-o-briefcase' => 'Bisnis / Profesional',
            'heroicon-o-shield-check' => 'Perlindungan / Kepatuhan',
            'heroicon-o-calculator' => 'Perhitungan Pajak',
            'heroicon-o-academic-cap' => 'Keahlian / Sertifikasi',
            'heroicon-o-user-group' => 'Klien / Tim',
            'heroicon-o-building-office-2' => 'Kantor / Perusahaan',
            'heroicon-o-check-badge' => 'Terverifikasi / Kualifikasi',
            'heroicon-o-document-magnifying-glass' => 'Telaah Dokumen',
        ];
    }
}
