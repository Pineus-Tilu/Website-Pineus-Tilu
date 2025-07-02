<?php

namespace App\Providers\Filament;

use Filament\Navigation\UserMenuItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Route;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->brandName('Pineus Tilu')
            ->brandLogo(asset('images/logo.png')) // optional: jika ada logo
            ->brandLogoHeight('5rem') // optional: ukuran logo
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
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
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