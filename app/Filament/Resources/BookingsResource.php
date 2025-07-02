<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingsResource\Pages;
use App\Models\Booking;
use App\Models\AreaUnit;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BookingsResource extends Resource
{
    protected static ?string $model = Booking::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Bookings';
    protected static ?string $pluralModelLabel = 'Bookings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('User')
                    ->options(User::all()->pluck('name', 'id'))
                    ->searchable()
                    ->nullable(),
                
                Forms\Components\Select::make('unit_id')
                    ->label('Unit/Deck')
                    ->options(AreaUnit::with('facility.area')->get()->mapWithKeys(function ($unit) {
                        return [$unit->id => $unit->facility->area->name . ' - ' . $unit->unit_name];
                    }))
                    ->required()
                    ->searchable(),
                
                Forms\Components\DatePicker::make('booking_for_date')
                    ->label('Tanggal Booking')
                    ->required()
                    ->minDate(now()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->sortable()
                    ->searchable()
                    ->placeholder('Guest'),
                
                Tables\Columns\TextColumn::make('unit.facility.area.name')
                    ->label('Area/Fasilitas')
                    ->sortable()
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('unit.unit_name')
                    ->label('Deck/Unit')
                    ->sortable()
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('booking_for_date')
                    ->label('Tanggal Booking')
                    ->date('d M Y')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('bookingDetail.nama')
                    ->label('Nama Pemesan')
                    ->searchable()
                    ->placeholder('-'),
                
                Tables\Columns\TextColumn::make('bookingDetail.email')
                    ->label('Email')
                    ->searchable()
                    ->placeholder('-'),
                
                Tables\Columns\TextColumn::make('bookingDetail.telepon')
                    ->label('Telepon')
                    ->placeholder('-'),
                
                Tables\Columns\TextColumn::make('bookingDetail.number_of_people')
                    ->label('Jumlah Orang')
                    ->placeholder('-'),
                
                Tables\Columns\TextColumn::make('bookingDetail.total_price')
                    ->label('Total Harga')
                    ->money('IDR')
                    ->placeholder('-'),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('unit_id')
                    ->label('Area/Unit')
                    ->options(AreaUnit::with('facility.area')->get()->mapWithKeys(function ($unit) {
                        return [$unit->id => $unit->facility->area->name . ' - ' . $unit->unit_name];
                    })),
                
                Tables\Filters\Filter::make('booking_for_date')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'], fn($q) => $q->whereDate('booking_for_date', '>=', $data['from']))
                            ->when($data['until'], fn($q) => $q->whereDate('booking_for_date', '<=', $data['until']));
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'view' => Pages\ViewBookings::route('/{record}'),
            'edit' => Pages\EditBookings::route('/{record}/edit'),
        ];
    }
}