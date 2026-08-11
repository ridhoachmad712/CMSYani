<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Konten Artikel')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, $state, Set $set) {
                                if ($operation === 'create') {
                                    $set('slug', Str::slug((string) $state));
                                }
                            })
                            ->columnSpanFull(),
                        TextInput::make('slug')
                            ->label('Slug (URL)')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->columnSpanFull(),
                        Textarea::make('excerpt')
                            ->label('Ringkasan')
                            ->rows(2)
                            ->maxLength(500)
                            ->helperText('Tampil di kartu preview & hasil pencarian.')
                            ->columnSpanFull(),
                        RichEditor::make('content')
                            ->label('Isi Artikel')
                            ->required()
                            ->columnSpanFull(),
                    ]),
                Section::make('Publikasi & Kategori')
                    ->columns(2)
                    ->schema([
                        Select::make('article_category_id')
                            ->label('Kategori')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->native(false),
                        TextInput::make('author_name')
                            ->label('Penulis')
                            ->required()
                            ->default('Muhammad Yani')
                            ->maxLength(255),
                        Toggle::make('is_published')
                            ->label('Terbitkan')
                            ->helperText('Editor dapat menerbitkan langsung tanpa persetujuan.'),
                        DateTimePicker::make('published_at')
                            ->label('Jadwal Terbit')
                            ->helperText('Opsional. Kosongkan untuk terbit segera saat diaktifkan.'),
                    ]),
                Section::make('Media & SEO')
                    ->columns(2)
                    ->collapsed()
                    ->schema([
                        FileUpload::make('featured_image')
                            ->label('Gambar Utama')
                            ->image()
                            ->disk('public')
                            ->directory('articles')
                            ->visibility('public')
                            ->imageEditor()
                            ->maxSize(2048)
                            ->fetchFileInformation(false)
                            ->columnSpanFull(),
                        TextInput::make('meta_title')
                            ->label('Meta Title (SEO)')
                            ->maxLength(255),
                        TextInput::make('meta_description')
                            ->label('Meta Description (SEO)')
                            ->maxLength(255),
                    ]),
            ]);
    }
}
