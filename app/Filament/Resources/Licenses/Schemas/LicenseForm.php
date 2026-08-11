<?php

namespace App\Filament\Resources\Licenses\Schemas;

use App\Support\Icons;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LicenseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Nama Izin / Kualifikasi')
                    ->required()
                    ->maxLength(255),
                TextInput::make('number')
                    ->label('Nomor Izin')
                    ->required()
                    ->maxLength(255),
                Select::make('icon')
                    ->label('Ikon')
                    ->options(Icons::options())
                    ->searchable()
                    ->native(false)
                    ->helperText('Ikon Heroicon yang tampil di kartu izin.'),
                TextInput::make('order')
                    ->label('Urutan')
                    ->numeric()
                    ->default(0)
                    ->helperText('Urutan tampil. Bisa juga diatur lewat drag-and-drop di tabel.'),
            ]);
    }
}
