<?php

namespace App\Filament\Resources\BookingsResource\Pages;

use App\Filament\Resources\BookingsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ViewBookings extends ViewRecord
{
    protected static string $resource = BookingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->label('Edit Booking')
                ->icon('heroicon-o-pencil'),
                
            Actions\Action::make('download_invoice')
                ->label('Download Invoice')
                ->icon('heroicon-o-document-arrow-down')
                ->color('success')
                ->url(fn (): string => route('invoice.download', $this->record->id))
                ->openUrlInNewTab()
                ->visible(fn (): bool => 
                    $this->record->bookingDetail && 
                    in_array($this->record->status->name, ['success', 'pending'])
                ),
                
            Actions\Action::make('preview_invoice')
                ->label('Preview Invoice')
                ->icon('heroicon-o-eye')
                ->color('info')
                ->url(fn (): string => route('invoice.preview', $this->record->id))
                ->openUrlInNewTab()
                ->visible(fn (): bool => 
                    $this->record->bookingDetail && 
                    in_array($this->record->status->name, ['success', 'pending'])
                ),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Informasi Booking')
                    ->schema([
                        Infolists\Components\Grid::make(3)
                            ->schema([
                                Infolists\Components\TextEntry::make('id')
                                    ->label('Booking ID')
                                    ->badge()
                                    ->color('primary'),
                                    
                                Infolists\Components\TextEntry::make('invoice_number')
                                    ->label('Invoice Number')
                                    ->badge()
                                    ->color('success')
                                    ->default(fn ($record) => $record->invoice_number ?? 'INV-' . str_pad($record->id, 6, '0', STR_PAD_LEFT)),
                                    
                                Infolists\Components\TextEntry::make('status.name')
                                    ->label('Status Booking')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'pending' => 'warning',
                                        'success' => 'success',
                                        'cancel' => 'danger',
                                        default => 'gray',
                                    }),
                            ]),
                            
                        Infolists\Components\Grid::make(2)
                            ->schema([
                                Infolists\Components\TextEntry::make('created_at')
                                    ->label('Tanggal Booking Dibuat')
                                    ->dateTime('d F Y, H:i')
                                    ->icon('heroicon-o-calendar'),
                                    
                                Infolists\Components\TextEntry::make('updated_at')
                                    ->label('Terakhir Diupdate')
                                    ->since()
                                    ->icon('heroicon-o-clock'),
                            ]),
                    ])
                    ->columns(1),

                Infolists\Components\Section::make('Detail Customer')
                    ->schema([
                        Infolists\Components\Grid::make(3)
                            ->schema([
                                Infolists\Components\TextEntry::make('bookingDetail.nama')
                                    ->label('Nama Lengkap')
                                    ->default('Guest')
                                    ->icon('heroicon-o-user'),
                                    
                                Infolists\Components\TextEntry::make('bookingDetail.email')
                                    ->label('Email')
                                    ->default('-')
                                    ->icon('heroicon-o-envelope')
                                    ->copyable(),
                                    
                                Infolists\Components\TextEntry::make('bookingDetail.telepon')
                                    ->label('Nomor Telepon')
                                    ->default('-')
                                    ->icon('heroicon-o-phone')
                                    ->copyable(),
                            ]),
                            
                        Infolists\Components\TextEntry::make('user.name')
                            ->label('User Account')
                            ->default('Guest User')
                            ->icon('heroicon-o-user-circle')
                            ->visible(fn ($record) => $record->user_id),
                    ])
                    ->columns(1),

                Infolists\Components\Section::make('Detail Reservasi')
                    ->schema([
                        Infolists\Components\Grid::make(2)
                            ->schema([
                                Infolists\Components\TextEntry::make('unit.area.name')
                                    ->label('Area Camping')
                                    ->badge()
                                    ->color('primary')
                                    ->icon('heroicon-o-map-pin'),
                                    
                                Infolists\Components\TextEntry::make('unit.unit_name')
                                    ->label('Unit/Deck')
                                    ->badge()
                                    ->color('secondary')
                                    ->icon('heroicon-o-home'),
                            ]),
                            
                        Infolists\Components\Grid::make(3)
                            ->schema([
                                Infolists\Components\TextEntry::make('bookingDetail.check_in')
                                    ->label('Check In')
                                    ->date('d F Y')
                                    ->icon('heroicon-o-calendar-days')
                                    ->color('success'),
                                    
                                Infolists\Components\TextEntry::make('bookingDetail.check_out')
                                    ->label('Check Out')
                                    ->date('d F Y')
                                    ->icon('heroicon-o-calendar-days')
                                    ->color('danger'),
                                    
                                Infolists\Components\TextEntry::make('nights')
                                    ->label('Jumlah Malam')
                                    ->getStateUsing(function ($record): string {
                                        if ($record->bookingDetail) {
                                            $nights = \Carbon\Carbon::parse($record->bookingDetail->check_in)
                                                ->diffInDays(\Carbon\Carbon::parse($record->bookingDetail->check_out));
                                            return $nights . ' malam';
                                        }
                                        return '1 malam';
                                    })
                                    ->badge()
                                    ->color('info')
                                    ->icon('heroicon-o-moon'),
                            ]),
                            
                        Infolists\Components\Grid::make(2)
                            ->schema([
                                Infolists\Components\TextEntry::make('bookingDetail.number_of_people')
                                    ->label('Jumlah Orang')
                                    ->default(1)
                                    ->suffix(' orang')
                                    ->icon('heroicon-o-users'),
                                    
                                Infolists\Components\TextEntry::make('bookingDetail.notes')
                                    ->label('Catatan Khusus')
                                    ->default('Tidak ada catatan')
                                    ->icon('heroicon-o-chat-bubble-left-ellipsis'),
                            ]),
                    ])
                    ->columns(1),

                Infolists\Components\Section::make('Detail Pembayaran')
                    ->schema([
                        Infolists\Components\Grid::make(2)
                            ->schema([
                                Infolists\Components\TextEntry::make('base_price')
                                    ->label('Harga Dasar')
                                    ->getStateUsing(function ($record): string {
                                        if ($record->bookingDetail) {
                                            $basePrice = $record->bookingDetail->total_price - ($record->bookingDetail->extra_charge ?? 0);
                                            return 'Rp ' . number_format($basePrice, 0, ',', '.');
                                        }
                                        return 'Rp 0';
                                    })
                                    ->icon('heroicon-o-banknotes'),
                                    
                                Infolists\Components\TextEntry::make('bookingDetail.extra_charge')
                                    ->label('Extra Charge')
                                    ->money('IDR')
                                    ->default(0)
                                    ->icon('heroicon-o-plus-circle'),
                            ]),
                            
                        Infolists\Components\TextEntry::make('bookingDetail.total_price')
                            ->label('Total Pembayaran')
                            ->money('IDR')
                            ->default(0)
                            ->size('lg')
                            ->weight('bold')
                            ->color('success')
                            ->icon('heroicon-o-currency-dollar'),
                    ])
                    ->columns(1),

                Infolists\Components\Section::make('Informasi Pembayaran')
                    ->schema([
                        Infolists\Components\Grid::make(2)
                            ->schema([
                                Infolists\Components\TextEntry::make('payment.order_id')
                                    ->label('Order ID')
                                    ->default('Belum ada pembayaran')
                                    ->copyable()
                                    ->icon('heroicon-o-hashtag'),
                                    
                                Infolists\Components\TextEntry::make('payment.payment_type')
                                    ->label('Metode Pembayaran')
                                    ->default('Belum ada pembayaran')
                                    ->formatStateUsing(fn (?string $state): string => 
                                        $state ? ucwords(str_replace('_', ' ', $state)) : 'Belum ada pembayaran'
                                    )
                                    ->icon('heroicon-o-credit-card'),
                            ]),
                            
                        Infolists\Components\Grid::make(2)
                            ->schema([
                                Infolists\Components\TextEntry::make('payment.transaction_status')
                                    ->label('Status Transaksi')
                                    ->default('Belum ada pembayaran')
                                    ->badge()
                                    ->color(fn (?string $state): string => match ($state) {
                                        'settlement', 'capture' => 'success',
                                        'pending' => 'warning',
                                        'deny', 'cancel', 'expire' => 'danger',
                                        default => 'gray',
                                    })
                                    ->icon('heroicon-o-check-badge'),
                                    
                                Infolists\Components\TextEntry::make('payment.gross_amount')
                                    ->label('Jumlah Dibayar')
                                    ->money('IDR')
                                    ->default(0)
                                    ->icon('heroicon-o-banknotes'),
                            ]),
                    ])
                    ->columns(1)
                    ->visible(fn ($record) => $record->payment),

                Infolists\Components\Section::make('Fasilitas Area')
                    ->schema([
                        Infolists\Components\TextEntry::make('facilities_pribadi')
                            ->label('Fasilitas Pribadi')
                            ->getStateUsing(function ($record): string {
                                if ($record->unit && $record->unit->area) {
                                    $facilities = \App\Models\Facility::where('area_id', $record->unit->area->id)
                                        ->where('type', 'pribadi')
                                        ->pluck('description')
                                        ->toArray();
                                    return !empty($facilities) ? implode(', ', $facilities) : 'Tidak ada fasilitas pribadi';
                                }
                                return 'Tidak ada fasilitas pribadi';
                            })
                            ->listWithLineBreaks()
                            ->icon('heroicon-o-home-modern'),
                            
                        Infolists\Components\TextEntry::make('facilities_umum')
                            ->label('Fasilitas Umum')
                            ->getStateUsing(function ($record): string {
                                if ($record->unit && $record->unit->area) {
                                    $facilities = \App\Models\Facility::where('area_id', $record->unit->area->id)
                                        ->where('type', 'umum')
                                        ->pluck('description')
                                        ->toArray();
                                    return !empty($facilities) ? implode(', ', $facilities) : 'Tidak ada fasilitas umum';
                                }
                                return 'Tidak ada fasilitas umum';
                            })
                            ->listWithLineBreaks()
                            ->icon('heroicon-o-building-office-2'),
                    ])
                    ->columns(1),
            ]);
    }
}