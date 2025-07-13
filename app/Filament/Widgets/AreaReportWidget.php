<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\BookingDetail;
use Filament\Widgets\Widget;

class AreaReportWidget extends Widget
{
    protected static string $view = 'filament.widgets.area-report-widget';
    protected static ?string $heading = 'Laporan Booking per Area';
    
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';
    protected function getViewData(): array
    {
        $areaNames = [
            'Pineus Tilu I',
            'Pineus Tilu II',
            'Pineus Tilu III VIP (Tenda)',
            'Pineus Tilu III VIP (Kabin)',
            'Pineus Tilu IV',
        ];

        $areaStats = [];

        foreach ($areaNames as $name) {
            $total = Booking::whereHas('unit.area', function($q) use ($name) {
                $q->where('name', $name);
            })->count();

            $success = Booking::whereHas('unit.area', function($q) use ($name) {
                $q->where('name', $name);
            })->whereHas('status', function($q) {
                $q->where('name', 'success');
            })->count();

            $pending = Booking::whereHas('unit.area', function($q) use ($name) {
                $q->where('name', $name);
            })->whereHas('status', function($q) {
                $q->where('name', 'pending');
            })->count();

            $cancel = Booking::whereHas('unit.area', function($q) use ($name) {
                $q->where('name', $name);
            })->whereHas('status', function($q) {
                $q->where('name', 'cancel');
            })->count();

            // Total pendapatan dari BookingDetail dengan status booking 'success' dan area sesuai
            $income = BookingDetail::whereHas('booking.unit.area', function($q) use ($name) {
                    $q->where('name', $name);
                })
                ->whereHas('booking.status', function($q) {
                    $q->where('name', 'success');
                })
                ->sum('total_price');

            $areaStats[] = [
                'name' => $name,
                'total' => $total,
                'success' => $success,
                'pending' => $pending,
                'cancel' => $cancel,
                'income' => $income,
            ];
        }

        return [
            'areaStats' => $areaStats,
        ];
    }
}