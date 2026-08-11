<?php

namespace App\Filament\Resources\GlossaryTerms\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class GlossaryTermForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('term')
                    ->label('Istilah')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (string $operation, $state, Set $set) {
                        if ($operation === 'create') {
                            $set('slug', Str::slug((string) $state));
                        }
                    }),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Textarea::make('definition')
                    ->label('Definisi')
                    ->required()
                    ->rows(3)
                    ->columnSpanFull(),
                TextInput::make('category')
                    ->label('Kategori')
                    ->maxLength(255),
                TextInput::make('order')
                    ->label('Urutan')
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->label('Aktif (tampil di publik)')
                    ->helperText('Draft sampai ditinjau. Aktifkan setelah konten diverifikasi.'),
            ]);
    }
}
