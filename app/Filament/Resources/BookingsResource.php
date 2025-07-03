<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingsResource\Pages;
use App\Models\Booking;
use App\Models\BookingStatus;
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
                    ->options(AreaUnit::with('area')->get()->mapWithKeys(function ($unit) {
                        return [$unit->id => $unit->area->name . ' - ' . $unit->unit_name];
                    }))
                    ->required()
                    ->searchable(),
                
                Forms\Components\DatePicker::make('booking_for_date')
                    ->label('Tanggal Booking')
                    ->required()
                    ->minDate(now()),

                Forms\Components\Select::make('status_id')
                    ->label('Status')
                    ->options(BookingStatus::all()->pluck('name', 'id'))
                    ->required()
                    ->default(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->size('sm')
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('bookingDetail.nama')
                    ->label('Nama')
                    ->searchable()
                    ->placeholder('Guest')
                    ->size('sm')
                    ->weight('medium')
                    ->wrap(),
                
                Tables\Columns\TextColumn::make('unit.area.name')
                    ->label('Area')
                    ->sortable()
                    ->searchable()
                    ->size('sm')
                    ->toggleable(),
                
                Tables\Columns\TextColumn::make('unit.unit_name')
                    ->label('Unit')
                    ->sortable()
                    ->searchable()
                    ->size('sm'),
                
                Tables\Columns\TextColumn::make('booking_for_date')
                    ->label('Tanggal')
                    ->date('d/m/Y')
                    ->sortable()
                    ->size('sm'),

                Tables\Columns\BadgeColumn::make('status.name')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'success',
                        'danger' => 'cancel',
                    ])
                    ->size('sm')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('bookingDetail.email')
                    ->label('Email')
                    ->searchable()
                    ->placeholder('-')
                    ->size('sm')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->wrap(),
                
                Tables\Columns\TextColumn::make('bookingDetail.telepon')
                    ->label('Telepon')
                    ->placeholder('-')
                    ->size('sm')
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('bookingDetail.number_of_people')
                    ->label('Orang')
                    ->placeholder('-')
                    ->size('sm')
                    ->alignCenter(),
                
                Tables\Columns\TextColumn::make('bookingDetail.total_price')
                    ->label('Total')
                    ->money('IDR')
                    ->placeholder('-')
                    ->size('sm')
                    ->weight('semibold')
                    ->color('success'),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->since()
                    ->size('sm')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('unit_id')
                    ->label('Area/Unit')
                    ->options(AreaUnit::with('area')->get()->mapWithKeys(function ($unit) {
                        return [$unit->id => $unit->area->name . ' - ' . $unit->unit_name];
                    }))
                    ->multiple(),

                Tables\Filters\SelectFilter::make('status_id')
                    ->label('Status')
                    ->options(BookingStatus::all()->pluck('name', 'id'))
                    ->multiple(),
                
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
                
                Tables\Filters\Filter::make('today')
                    ->label('Hari Ini')
                    ->query(fn ($query) => $query->whereDate('created_at', today()))
                    ->toggle(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    
                    Tables\Actions\Action::make('confirm')
                        ->label('Konfirmasi')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function (Booking $record) {
                            $record->update(['status_id' => 2]); // 2 = success
                        })
                        ->visible(fn (Booking $record) => $record->status->name === 'pending'),

                    Tables\Actions\Action::make('cancel')
                        ->label('Cancel')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->action(function (Booking $record) {
                            $record->update(['status_id' => 3]); // 3 = cancel
                        })
                        ->visible(fn (Booking $record) => in_array($record->status->name, ['pending', 'success']))
                        ->requiresConfirmation(),

                    Tables\Actions\DeleteAction::make(),
                ])
                ->label('Actions')
                ->icon('heroicon-m-ellipsis-vertical')
                ->size('sm')
                ->color('gray')
                ->button(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    
                    Tables\Actions\BulkAction::make('confirm_selected')
                        ->label('Konfirmasi Terpilih')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function ($records) {
                            $records->each(function ($record) {
                                if ($record->status->name === 'pending') {
                                    $record->update(['status_id' => 2]);
                                }
                            });
                        })
                        ->requiresConfirmation(),

                    Tables\Actions\BulkAction::make('cancel_selected')
                        ->label('Cancel Terpilih')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->action(function ($records) {
                            $records->each(function ($record) {
                                if (in_array($record->status->name, ['pending', 'success'])) {
                                    $record->update(['status_id' => 3]);
                                }
                            });
                        })
                        ->requiresConfirmation(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated([10, 25, 50, 100])
            ->defaultPaginationPageOption(25)
            ->persistSortInSession()
            ->persistSearchInSession()
            ->persistFiltersInSession();
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