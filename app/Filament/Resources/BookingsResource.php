<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingsResource\Pages;
use App\Models\Booking;
use App\Models\Bookings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BookingsResource extends Resource
{
    protected static ?string $model = Booking::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Bookings';
    protected static ?string $pluralModelLabel = 'Bookings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_pemesan')->required(),
                Forms\Components\TextInput::make('email')->email(),
                Forms\Components\TextInput::make('fasilitas'),
                Forms\Components\TextInput::make('jumlah_orang'),
                Forms\Components\DatePicker::make('tanggal'),
                // Tambahkan field lain sesuai kebutuhan
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_pemesan')->label('Nama Pemesan'),
                Tables\Columns\TextColumn::make('email')->label('Email'),
                Tables\Columns\TextColumn::make('fasilitas')->label('Fasilitas'),
                Tables\Columns\TextColumn::make('jumlah_orang')->label('Jumlah Orang'),
                Tables\Columns\TextColumn::make('tanggal')->label('Tanggal'),
                // Tambahkan kolom lain sesuai kebutuhan
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBookings::route('/create'),
            'edit' => Pages\EditBookings::route('/{record}/edit'),
        ];
    }
}