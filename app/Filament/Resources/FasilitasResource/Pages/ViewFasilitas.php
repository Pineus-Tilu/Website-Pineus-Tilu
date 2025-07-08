<?php

namespace App\Filament\Resources\FasilitasResource\Pages;

use App\Filament\Resources\FasilitasResource;
use App\Models\AreaUnit;
use App\Models\Price;
use App\Models\Facility;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ViewFasilitas extends ViewRecord
{
    protected static string $resource = FasilitasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Informasi Area')
                    ->schema([
                        Infolists\Components\TextEntry::make('name')
                            ->label('Nama Area')
                            ->size(Infolists\Components\TextEntry\TextEntrySize::Large)
                            ->weight('bold')
                            ->color('primary'),
                            
                        Infolists\Components\TextEntry::make('jumlah_unit')
                            ->label('Jumlah Area Unit')
                            ->getStateUsing(function ($record) {
                                return AreaUnit::where('area_id', $record->id)->count() . ' Unit';
                            })
                            ->icon('heroicon-o-building-office-2')
                            ->color('success'),
                            
                        Infolists\Components\TextEntry::make('tipe_area')
                            ->label('Tipe Area')
                            ->getStateUsing(function ($record) {
                                // Tentukan tipe berdasarkan nama area
                                if (str_contains($record->name, 'VIP')) {
                                    return 'VIP';
                                } else {
                                    return 'Reguler';
                                }
                            })
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'VIP' => 'warning',
                                'Reguler' => 'primary',
                            }),
                            
                        Infolists\Components\TextEntry::make('extra_charge')
                            ->label('Extra Charge')
                            ->money('IDR')
                            ->icon('heroicon-o-currency-dollar')
                            ->color('info'),
                    ])
                    ->columns(2),
                    
                Infolists\Components\Section::make('Fasilitas Pribadi')
                    ->schema([
                        Infolists\Components\TextEntry::make('fasilitas_pribadi_list')
                            ->label('')
                            ->getStateUsing(function ($record) {
                                $facilities = Facility::where('area_id', $record->id)
                                    ->where('type', 'pribadi')
                                    ->pluck('description');
                                    
                                if ($facilities->isEmpty()) {
                                    return 'Tidak ada fasilitas pribadi yang tersedia';
                                }
                                
                                return $facilities->map(function ($item, $index) {
                                    return ($index + 1) . '. ' . $item;
                                })->implode("\n");
                            })
                            ->html()
                            ->formatStateUsing(function ($state) {
                                return nl2br(e($state));
                            })
                            ->color('success')
                            ->icon('heroicon-o-check-circle'),
                    ])
                    ->collapsible()
                    ->collapsed(false),
                    
                Infolists\Components\Section::make('Fasilitas Umum')
                    ->schema([
                        Infolists\Components\TextEntry::make('fasilitas_umum_list')
                            ->label('')
                            ->getStateUsing(function ($record) {
                                $facilities = Facility::where('area_id', $record->id)
                                    ->where('type', 'umum')
                                    ->pluck('description');
                                    
                                if ($facilities->isEmpty()) {
                                    return 'Tidak ada fasilitas umum yang tersedia';
                                }
                                
                                return $facilities->map(function ($item, $index) {
                                    return ($index + 1) . '. ' . $item;
                                })->implode("\n");
                            })
                            ->html()
                            ->formatStateUsing(function ($state) {
                                return nl2br(e($state));
                            })
                            ->color('primary')
                            ->icon('heroicon-o-check-circle'),
                    ])
                    ->collapsible()
                    ->collapsed(false),
                    
                Infolists\Components\Section::make('Informasi Harga')
                    ->schema([
                        Infolists\Components\TextEntry::make('harga_weekday')
                            ->label('Harga Weekday')
                            ->getStateUsing(function ($record) {
                                $areaUnit = AreaUnit::where('area_id', $record->id)->first();
                                if (!$areaUnit) return 'Belum diatur';
                                
                                $price = Price::where('unit_id', $areaUnit->id)->first();
                                return $price ? $price->weekday : 'Belum diatur';
                            })
                            ->money('IDR')
                            ->icon('heroicon-o-calendar-days')
                            ->color('primary'),
                            
                        Infolists\Components\TextEntry::make('harga_weekend')
                            ->label('Harga Weekend')
                            ->getStateUsing(function ($record) {
                                $areaUnit = AreaUnit::where('area_id', $record->id)->first();
                                if (!$areaUnit) return 'Belum diatur';
                                
                                $price = Price::where('unit_id', $areaUnit->id)->first();
                                return $price ? $price->weekend : 'Belum diatur';
                            })
                            ->money('IDR')
                            ->icon('heroicon-o-calendar-days')
                            ->color('warning'),
                            
                        Infolists\Components\TextEntry::make('harga_highseason')
                            ->label('Harga High Season')
                            ->getStateUsing(function ($record) {
                                $areaUnit = AreaUnit::where('area_id', $record->id)->first();
                                if (!$areaUnit) return 'Belum diatur';
                                
                                $price = Price::where('unit_id', $areaUnit->id)->first();
                                return $price ? $price->highseason : 'Belum diatur';
                            })
                            ->money('IDR')
                            ->icon('heroicon-o-calendar-days')
                            ->color('danger'),
                    ])
                    ->columns(3),
            ]);
    }
}