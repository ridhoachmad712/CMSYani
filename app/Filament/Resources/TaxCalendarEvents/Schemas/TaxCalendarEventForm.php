<?php

namespace App\Filament\Resources\TaxCalendarEvents\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TaxCalendarEventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Select::make('category')
                    ->label('Kategori')
                    ->options([
                        'Pembayaran' => 'Pembayaran',
                        'SPT Masa' => 'SPT Masa',
                        'SPT Tahunan' => 'SPT Tahunan',
                    ])
                    ->required()
                    ->native(false),
                TextInput::make('due_rule')
                    ->label('Aturan Jatuh Tempo')
                    ->required()
                    ->maxLength(255)
                    ->helperText('Teks bebas, mis. "Paling lambat tanggal 20 bulan berikutnya".'),
                Textarea::make('description')
                    ->label('Keterangan')
                    ->rows(2)
                    ->columnSpanFull(),
                TextInput::make('order')
                    ->label('Urutan')
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->label('Aktif (tampil di publik)')
                    ->helperText('Draft sampai ditinjau. Tanggal wajib diverifikasi sebelum diaktifkan.'),
            ]);
    }
}
