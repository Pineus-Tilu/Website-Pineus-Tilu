<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentBookingsWidget extends BaseWidget
{
    protected static ?string $heading = 'Booking Terbaru';
    protected static ?int $sort = 5;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Booking::query()
                    ->with(['user', 'unit.area', 'status', 'bookingDetail'])
                    ->latest()
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->size('sm'),

                Tables\Columns\TextColumn::make('bookingDetail.nama')
                    ->label('Nama')
                    ->placeholder('Guest')
                    ->searchable()
                    ->size('sm'),

                Tables\Columns\TextColumn::make('unit.area.name')
                    ->label('Area')
                    ->size('sm'),

                Tables\Columns\TextColumn::make('unit.unit_name')
                    ->label('Unit')
                    ->size('sm'),

                Tables\Columns\TextColumn::make('booking_for_date')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->size('sm'),

                Tables\Columns\BadgeColumn::make('status.name')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'success',
                        'danger' => 'cancel',
                    ])
                    ->size('sm'),

                Tables\Columns\TextColumn::make('bookingDetail.total_price')
                    ->label('Total')
                    ->money('IDR')
                    ->placeholder('-')
                    ->size('sm'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->since()
                    ->size('sm'),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Lihat')
                    ->icon('heroicon-o-eye')
                    ->size('sm')
                    ->url(fn (Booking $record): string => route('filament.admin.resources.bookings.view', $record)),
            ])
            ->paginated(false)
            ->defaultSort('created_at', 'desc');
    }
}