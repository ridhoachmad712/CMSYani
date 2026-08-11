<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactMessageInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Pengirim')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('name')
                            ->label('Nama'),
                        TextEntry::make('email')
                            ->label('Email')
                            ->copyable()
                            ->url(fn ($record): string => 'mailto:' . $record->email),
                        TextEntry::make('phone')
                            ->label('Telepon / WA')
                            ->placeholder('Tidak diisi')
                            ->copyable(),
                        TextEntry::make('subject')
                            ->label('Subjek')
                            ->placeholder('Tidak diisi'),
                    ]),
                Section::make('Pesan')
                    ->schema([
                        TextEntry::make('message')
                            ->label('Isi Pesan')
                            ->prose()
                            ->columnSpanFull(),
                    ]),
                Section::make('Status')
                    ->columns(2)
                    ->schema([
                        IconEntry::make('is_read')
                            ->label('Sudah Dibaca')
                            ->boolean(),
                        TextEntry::make('created_at')
                            ->label('Diterima')
                            ->dateTime('d M Y H:i'),
                    ]),
            ]);
    }
}
