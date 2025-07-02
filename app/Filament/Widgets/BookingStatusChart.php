<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Widgets\ChartWidget;

class BookingStatusChart extends ChartWidget
{
    protected static ?string $heading = 'Status Booking';
    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $pending = Booking::whereHas('status', function($q) {
            $q->where('name', 'pending');
        })->count();

        $success = Booking::whereHas('status', function($q) {
            $q->where('name', 'success');
        })->count();

        $cancel = Booking::whereHas('status', function($q) {
            $q->where('name', 'cancel');
        })->count();

        return [
            'datasets' => [
                [
                    'data' => [$pending, $success, $cancel],
                    'backgroundColor' => [
                        'rgb(251, 191, 36)', // warning/pending
                        'rgb(34, 197, 94)',  // success
                        'rgb(239, 68, 68)',  // danger/cancel
                    ],
                ],
            ],
            'labels' => ['Pending', 'Success', 'Cancel'],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}