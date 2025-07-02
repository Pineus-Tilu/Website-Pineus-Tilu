<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\BookingDetail;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BookingStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $totalBookings = Booking::count();
        $pendingBookings = Booking::whereHas('status', function($q) {
            $q->where('name', 'pending');
        })->count();
        $successBookings = Booking::whereHas('status', function($q) {
            $q->where('name', 'success');
        })->count();
        $cancelBookings = Booking::whereHas('status', function($q) {
            $q->where('name', 'cancel');
        })->count();
        
        $totalRevenue = BookingDetail::whereHas('booking.status', function($q) {
            $q->where('name', 'success');
        })->sum('total_price');

        $todayBookings = Booking::whereDate('created_at', today())->count();

        return [
            Stat::make('Total Bookings', $totalBookings)
                ->description('Total semua booking')
                ->descriptionIcon('heroicon-o-calendar')
                ->color('primary'),

            Stat::make('Pending Bookings', $pendingBookings)
                ->description('Menunggu konfirmasi')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning'),

            Stat::make('Success Bookings', $successBookings)
                ->description('Booking terkonfirmasi')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make('Total Revenue', 'Rp ' . number_format($totalRevenue, 0, ',', '.'))
                ->description('Revenue dari booking sukses')
                ->descriptionIcon('heroicon-o-banknotes')
                ->color('success'),

            Stat::make('Today Bookings', $todayBookings)
                ->description('Booking hari ini')
                ->descriptionIcon('heroicon-o-calendar-days')
                ->color('info'),

            Stat::make('Cancel Rate', $totalBookings > 0 ? round(($cancelBookings / $totalBookings) * 100, 1) . '%' : '0%')
                ->description('Persentase pembatalan')
                ->descriptionIcon('heroicon-o-x-circle')
                ->color('danger'),
        ];
    }
}