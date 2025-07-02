<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FasilitasResource\Pages;
use App\Models\Facility;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FasilitasResource extends Resource
{
    protected static ?string $model = Facility::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Fasilitas';
    protected static ?string $pluralModelLabel = 'Fasilitas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->label('Nama Fasilitas')
                    ->required(),
                Forms\Components\TextInput::make('harga')
                    ->label('Harga')
                    ->numeric()
                    ->required(),
                Forms\Components\FileUpload::make('galeri')
                    ->label('Galeri Fasilitas')
                    ->multiple()
                    ->image()
                    ->directory('fasilitas-galeri'),
                Forms\Components\TextInput::make('jumlah_maksimum_orang')
                    ->label('Jumlah Maksimum Orang')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->label('Nama Fasilitas')->searchable(),
                Tables\Columns\TextColumn::make('harga')->label('Harga')->money('IDR', true),
                Tables\Columns\ImageColumn::make('galeri')->label('Galeri')->circular(),
                Tables\Columns\TextColumn::make('jumlah_maksimum_orang')->label('Maks Orang'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFasilitas::route('/'),
            'create' => Pages\CreateFasilitas::route('/create'),
            'edit' => Pages\EditFasilitas::route('/{record}/edit'),
        ];
    }
}