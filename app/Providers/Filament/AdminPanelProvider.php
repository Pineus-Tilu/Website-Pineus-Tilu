<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Route;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Responses\Auth\Contracts\LogoutResponse;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->brandName('Pineus Tilu')
            ->brandLogo(asset('images/logo.png'))
            ->brandLogoHeight('5rem')
            ->login([
                'view' => 'auth.login',
                'action' => fn() => route('login'),
            ])
            ->authMiddleware([
                'role:Super Admin',
            ], isPersistent: true)
            ->routes(function () {
                Route::post('/logout', function () {
                    auth()->guard('web')->logout();
                    request()->session()->invalidate();
                    request()->session()->regenerateToken();

                    return redirect()->route('filament.admin.auth.login');
                })->name('filament.admin.logout');
            })
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Widget akun di pojok kanan atas
                Widgets\AccountWidget::class,
                
                // Widget statistik utama (baris pertama)
                \App\Filament\Widgets\BookingStatsWidget::class,
                
                // Widget charts (baris kedua - berdampingan)
                \App\Filament\Widgets\BookingChart::class,
                \App\Filament\Widgets\BookingStatusChart::class,
                
                // Widget tabel (baris ketiga - full width)
                \App\Filament\Widgets\RecentBookingsWidget::class,

                \App\Filament\Widgets\AreaReportWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
            ]);
    }

    public function boot()
    {
        Filament::serving(function () {
            Filament::registerLogoutResponse(function ($request) {
                return redirect('/');
            });
        });
    }
}