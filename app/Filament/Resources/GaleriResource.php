<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GaleriResource\Pages;
use App\Models\Galeri;
use App\Models\Area;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\BooleanColumn;

class GaleriResource extends Resource
{
    protected static ?string $model = Galeri::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Galeri';
    protected static ?string $modelLabel = 'Galeri';
    protected static ?string $pluralModelLabel = 'Galeri';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('area_id')
                    ->label('Area')
                    ->options(Area::all()->pluck('name', 'id'))
                    ->required()
                    ->searchable(),

                Select::make('type')
                    ->label('Tipe')
                    ->options([
                        'dashboard' => 'Dashboard',
                        'facility' => 'Fasilitas',
                    ])
                    ->required()
                    ->default('facility'),

                FileUpload::make('image_path')
                    ->label('Gambar')
                    ->directory('galeri')
                    ->image()
                    ->imageEditor()
                    ->maxSize(51200) // 50MB
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('title')
                    ->label('Judul')
                    ->maxLength(255),

                Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(3),

                // FIX: Field Urutan dengan validasi proper
                TextInput::make('sort_order')
                    ->label('Urutan')
                    ->numeric()
                    ->minValue(0) // Tidak boleh minus
                    ->maxValue(9999) // Maksimal 9999
                    ->default(0)
                    ->step(1) // Hanya integer
                    ->suffix('(0 = paling atas)')
                    ->helperText('Masukkan angka 0 atau lebih. Semakin kecil angka, semakin atas posisinya.')
                    ->required()
                    ->rules(['integer', 'min:0', 'max:9999']), // Tambahan validasi backend

                Toggle::make('is_featured')
                    ->label('Unggulan')
                    ->default(false)
                    ->helperText('Centang jika gambar ini ingin ditampilkan sebagai gambar utama di dashboard'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Gambar')
                    ->disk('public')
                    ->width(100)
                    ->height(80),
                
                TextColumn::make('area.name')
                    ->label('Area')
                    ->sortable()
                    ->searchable(),
                
                TextColumn::make('type')
                    ->label('Tipe')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'dashboard' => 'success',
                        'facility' => 'info',
                    })
                    ->sortable(),
                
                TextColumn::make('title')
                    ->label('Judul')
                    ->limit(30)
                    ->searchable(),
                
                TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable()
                    ->badge()
                    ->color('gray'),
                
                BooleanColumn::make('is_featured')
                    ->label('Unggulan')
                    ->sortable(),
                
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'dashboard' => 'Dashboard',
                        'facility' => 'Fasilitas',
                    ]),
                Tables\Filters\SelectFilter::make('area_id')
                    ->relationship('area', 'name')
                    ->label('Area'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order', 'asc'); // Sort by urutan ascending
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGaleri::route('/'),
            'create' => Pages\CreateGaleri::route('/create'),
            'edit' => Pages\EditGaleri::route('/{record}/edit'),
        ];
    }
}