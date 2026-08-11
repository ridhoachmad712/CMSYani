<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('client_name')
                    ->label('Nama Klien')
                    ->required()
                    ->maxLength(255),
                TextInput::make('client_role')
                    ->label('Jabatan / Keterangan')
                    ->maxLength(255)
                    ->placeholder('mis. Direktur PT ABC'),
                Textarea::make('content')
                    ->label('Isi Testimoni')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),
                Select::make('rating')
                    ->label('Rating')
                    ->options([1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5'])
                    ->native(false),
                FileUpload::make('photo')
                    ->label('Foto Klien')
                    ->image()
                    ->avatar()
                    ->disk('public')
                    ->directory('testimonials')
                    ->visibility('public')
                    ->maxSize(2048),
                TextInput::make('order')
                    ->label('Urutan')
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->label('Aktif (tampil di publik)'),
            ]);
    }
}
