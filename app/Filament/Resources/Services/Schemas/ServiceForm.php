<?php

namespace App\Filament\Resources\Services\Schemas;

use App\Support\Icons;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Nama Layanan')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (string $operation, $state, Set $set) {
                        if ($operation === 'create') {
                            $set('slug', Str::slug((string) $state));
                        }
                    }),
                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->helperText('Dipakai untuk anchor/tautan. Otomatis dari nama, boleh disesuaikan.'),
                Textarea::make('description')
                    ->label('Deskripsi')
                    ->required()
                    ->rows(3)
                    ->columnSpanFull(),
                Select::make('icon')
                    ->label('Ikon')
                    ->options(Icons::options())
                    ->searchable()
                    ->native(false)
                    ->helperText('Ikon Heroicon yang tampil di kartu layanan.'),
                TextInput::make('order')
                    ->label('Urutan')
                    ->numeric()
                    ->default(0)
                    ->helperText('Urutan tampil. Bisa juga diatur lewat drag-and-drop di tabel.'),
                Toggle::make('is_active')
                    ->label('Aktif (tampil di situs)')
                    ->default(true),
            ]);
    }
}
