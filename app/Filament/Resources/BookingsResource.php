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
use Illuminate\Database\Eloquent\Builder;

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
                Tables\Columns\TextColumn::make('bookingDetail.nama')
                    ->label('Nama')
                    ->searchable()
                    ->placeholder('Guest')
                    ->size('sm')
                    ->weight('medium')
                    ->wrap()
                    ->description(fn (Booking $record): ?string => 
                        $record->bookingDetail ? 
                        'Email: ' . ($record->bookingDetail->email ?? '-') . ' | Tel: ' . ($record->bookingDetail->telepon ?? '-') : 
                        null
                    ),
                
                Tables\Columns\TextColumn::make('unit.area.name')
                    ->label('Area')
                    ->sortable()
                    ->searchable(
                        query: function (Builder $query, string $search): Builder {
                            return $query->whereHas('unit.area', function (Builder $query) use ($search) {
                                $query->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"]);
                            });
                        }
                    )
                    ->size('sm')
                    ->color('primary')
                    ->weight('medium'),
                
                Tables\Columns\TextColumn::make('unit.unit_name')
                    ->label('Unit')
                    ->sortable()
                    ->searchable()
                    ->size('sm')
                    ->color('secondary'),
                
                Tables\Columns\TextColumn::make('check_in_out')
                    ->label('Check In - Check Out')
                    ->getStateUsing(function (Booking $record): string {
                        if ($record->bookingDetail) {
                            $checkIn = \Carbon\Carbon::parse($record->bookingDetail->check_in)->format('d/m/Y');
                            $checkOut = \Carbon\Carbon::parse($record->bookingDetail->check_out)->format('d/m/Y');
                            $nights = \Carbon\Carbon::parse($record->bookingDetail->check_in)
                                ->diffInDays(\Carbon\Carbon::parse($record->bookingDetail->check_out));
                            return $checkIn . ' - ' . $checkOut . ' (' . $nights . ' malam)';
                        }
                        return $record->booking_for_date ? 
                            \Carbon\Carbon::parse($record->booking_for_date)->format('d/m/Y') . ' (1 malam)' : 
                            '-';
                    })
                    ->size('sm')
                    ->wrap(),

                Tables\Columns\BadgeColumn::make('status.name')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'success',
                        'danger' => 'cancel',
                    ])
                    ->icons([
                        'heroicon-o-clock' => 'pending',
                        'heroicon-o-check-circle' => 'success',
                        'heroicon-o-x-circle' => 'cancel',
                    ])
                    ->size('sm')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('bookingDetail.total_price')
                    ->label('Total')
                    ->money('IDR')
                    ->placeholder('-')
                    ->size('sm')
                    ->weight('bold')
                    ->color('success')
                    ->getStateUsing(function (Booking $record): ?float {
                        return $record->bookingDetail ? $record->bookingDetail->total_price : null;
                    })
                    ->description(fn (Booking $record): ?string => 
                        $record->bookingDetail && $record->bookingDetail->number_of_people ? 
                        $record->bookingDetail->number_of_people . ' orang' : 
                        null
                    ),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('area')
                    ->label('Filter Area')
                    ->options(function () {
                        return \App\Models\Area::orderBy('name')->pluck('name', 'name');
                    })
                    ->query(function (Builder $query, array $data): Builder {
                        if (filled($data['value'])) {
                            return $query->whereHas('unit.area', function (Builder $query) use ($data) {
                                $query->where('name', $data['value']);
                            });
                        }
                        return $query;
                    }),

                Tables\Filters\SelectFilter::make('status_id')
                    ->label('Status')
                    ->options(BookingStatus::all()->pluck('name', 'id'))
                    ->multiple(),
                
                Tables\Filters\Filter::make('check_in_date')
                    ->label('Tanggal Check In')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['from'], function (Builder $query) use ($data) {
                                $query->whereHas('bookingDetail', function (Builder $query) use ($data) {
                                    $query->whereDate('check_in', '>=', $data['from']);
                                });
                            })
                            ->when($data['until'], function (Builder $query) use ($data) {
                                $query->whereHas('bookingDetail', function (Builder $query) use ($data) {
                                    $query->whereDate('check_in', '<=', $data['until']);
                                });
                            });
                    }),
                
                Tables\Filters\Filter::make('today')
                    ->label('Check In Hari Ini')
                    ->query(function (Builder $query): Builder {
                        return $query->whereHas('bookingDetail', function (Builder $query) {
                            $query->whereDate('check_in', today());
                        });
                    })
                    ->toggle(),
                    
                Tables\Filters\Filter::make('this_week')
                    ->label('Check In Minggu Ini')
                    ->query(function (Builder $query): Builder {
                        return $query->whereHas('bookingDetail', function (Builder $query) {
                            $query->whereBetween('check_in', [
                                now()->startOfWeek(),
                                now()->endOfWeek()
                            ]);
                        });
                    })
                    ->toggle(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->label('Lihat Detail')
                        ->icon('heroicon-o-eye')
                        ->color('info'),
                        
                    Tables\Actions\Action::make('download_invoice')
                        ->label('Download Invoice PDF')
                        ->icon('heroicon-o-document-arrow-down')
                        ->color('success')
                        ->url(fn (Booking $record): string => route('invoice.download', $record->id))
                        ->openUrlInNewTab()
                        ->visible(fn (Booking $record): bool => 
                            $record->bookingDetail && 
                            in_array($record->status->name, ['success', 'pending'])
                        ),
                ])
                ->label('Aksi')
                ->icon('heroicon-m-ellipsis-vertical')
                ->size('sm')
                ->color('gray')
                ->button(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('download_invoices')
                        ->label('Download Invoice Terpilih')
                        ->icon('heroicon-o-document-arrow-down')
                        ->color('success')
                        ->action(function ($records) {
                            // Handle multiple invoice downloads
                            foreach ($records as $record) {
                                if ($record->bookingDetail && in_array($record->status->name, ['success', 'pending'])) {
                                    // You can implement zip download or sequential downloads
                                    return redirect()->route('invoice.download', $record->id);
                                }
                            }
                        })
                        ->requiresConfirmation()
                        ->modalHeading('Download Invoice')
                        ->modalDescription('Download invoice untuk semua booking yang dipilih?'),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated([10, 25, 50, 100])
            ->defaultPaginationPageOption(25)
            ->persistSortInSession()
            ->persistSearchInSession()
            ->persistFiltersInSession()
            ->searchPlaceholder('Cari nama, area, unit...')
            ->emptyStateHeading('Tidak Ada Booking')
            ->emptyStateDescription('Belum ada booking yang tersedia dalam sistem.')
            ->emptyStateIcon('heroicon-o-calendar-days');
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
    
    // Disable create page karena booking dibuat dari frontend
    public static function canCreate(): bool
    {
        return false;
    }
    
    // Global search configuration
    public static function getGloballySearchableAttributes(): array
    {
        return ['bookingDetail.nama', 'unit.area.name', 'unit.unit_name'];
    }
    
    public static function getGlobalSearchResultTitle(\Illuminate\Database\Eloquent\Model $record): string
    {
        return $record->bookingDetail?->nama ?? 'Guest - Booking #' . $record->id;
    }
    
    public static function getGlobalSearchResultDetails(\Illuminate\Database\Eloquent\Model $record): array
    {
        return [
            'Area' => $record->unit?->area?->name ?? 'N/A',
            'Unit' => $record->unit?->unit_name ?? 'N/A',
            'Status' => $record->status?->name ?? 'N/A',
        ];
    }
}