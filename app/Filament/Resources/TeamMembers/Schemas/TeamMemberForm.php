<?php

namespace App\Filament\Resources\TeamMembers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class TeamMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Lengkap & Gelar')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (string $operation, $state, Set $set) {
                        if ($operation === 'create') {
                            // Slug dari nama tanpa gelar (sebelum koma pertama).
                            $set('slug', Str::slug(Str::before((string) $state, ',')));
                        }
                    })
                    ->placeholder('mis. Muhammad Yani, S.E., Ak., M.Ak., M.H., BKP.'),
                TextInput::make('slug')
                    ->label('Slug (URL halaman profil)')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->helperText('Dipakai untuk alamat halaman profil, mis. /tim/muhammad-yani.'),
                TextInput::make('role')
                    ->label('Jabatan / Peran')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('mis. Managing Partner / Senior Tax Consultant'),
                FileUpload::make('photo')
                    ->label('Foto Profil / Portret')
                    ->image()
                    ->disk('public')
                    ->directory('team')
                    ->visibility('public')
                    ->imageEditor()
                    ->maxSize(3072)
                    ->fetchFileInformation(false)
                    ->columnSpanFull()
                    ->helperText('Upload foto profil anggota tim. Disarankan rasio 3:4 atau persegi.'),
                Textarea::make('bio')
                    ->label('Bio Singkat / Ringkasan Keahlian')
                    ->rows(3)
                    ->columnSpanFull()
                    ->helperText('Tampil di kartu tim & bagian atas halaman profil.')
                    ->placeholder('Deskripsi singkat pengalaman atau keahlian spesialisasi perpajakan...'),
                RichEditor::make('detail')
                    ->label('Profil Lengkap')
                    ->columnSpanFull()
                    ->helperText('Informasi lengkap yang tampil di halaman profil pribadi (pendidikan, pengalaman, keahlian, dll).'),
                TextInput::make('email')
                    ->label('Email Kontak')
                    ->email()
                    ->maxLength(255),
                TextInput::make('linkedin_url')
                    ->label('URL LinkedIn / Profil')
                    ->url()
                    ->placeholder('https://linkedin.com/in/...'),
                TextInput::make('order')
                    ->label('Urutan')
                    ->numeric()
                    ->default(0)
                    ->helperText('Angka lebih kecil tampil lebih awal.'),
                Toggle::make('is_active')
                    ->label('Aktif (Tampil di Publik)')
                    ->default(true),
            ]);
    }
}
