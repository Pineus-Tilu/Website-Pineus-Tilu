<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FasilitasResource\Pages;
use App\Models\Area;
use App\Models\Price;
use App\Models\AreaUnit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class FasilitasResource extends Resource
{
    protected static ?string $model = Area::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationLabel = 'Area';
    protected static ?string $pluralModelLabel = 'Area';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Area')
                    ->required()
                    ->maxLength(255),
                
                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(3),
                
                Forms\Components\FileUpload::make('image_path')
                    ->label('Gambar Area')
                    ->image()
                    ->directory('area')
                    ->maxSize(5120), // 5MB
                
                Forms\Components\TextInput::make('extra_charge')
                    ->label('Extra Charge')
                    ->numeric()
                    ->prefix('Rp')
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Area')
                    ->sortable()
                    ->searchable(
                        query: function (Builder $query, string $search): Builder {
                            // CUSTOM SEARCH LOGIC YANG LEBIH SPESIFIK
                            return $query->where(function (Builder $query) use ($search) {
                                $originalSearch = $search;
                                $search = strtolower(trim($search));
                                
                                // Jika search kosong, kembalikan semua
                                if (empty($search)) {
                                    return $query;
                                }
                                
                                // Search exact match untuk area spesifik dengan angka/huruf di akhir
                                if ($search === '1' || $search === 'i') {
                                    // Hanya Pineus Tilu I (yang diakhiri dengan " I")
                                    $query->whereRaw('LOWER(name) LIKE ?', ['%pineus tilu i'])
                                          ->whereRaw('LOWER(name) NOT LIKE ?', ['%pineus tilu ii%'])
                                          ->whereRaw('LOWER(name) NOT LIKE ?', ['%pineus tilu iii%'])
                                          ->whereRaw('LOWER(name) NOT LIKE ?', ['%pineus tilu iv%']);
                                } elseif ($search === '2' || $search === 'ii') {
                                    // Hanya Pineus Tilu II
                                    $query->whereRaw('LOWER(name) LIKE ?', ['%pineus tilu ii'])
                                          ->whereRaw('LOWER(name) NOT LIKE ?', ['%pineus tilu iii%']);
                                } elseif ($search === '3' || $search === 'iii') {
                                    // Hanya Pineus Tilu III
                                    $query->whereRaw('LOWER(name) LIKE ?', ['%pineus tilu iii%']);
                                } elseif ($search === '4' || $search === 'iv') {
                                    // Hanya Pineus Tilu IV
                                    $query->whereRaw('LOWER(name) LIKE ?', ['%pineus tilu iv%']);
                                } 
                                // Search berdasarkan kata kunci spesifik
                                elseif ($search === 'vip') {
                                    $query->whereRaw('LOWER(name) LIKE ?', ['%vip%']);
                                } elseif ($search === 'tenda') {
                                    $query->whereRaw('LOWER(name) LIKE ?', ['%tenda%']);
                                } elseif ($search === 'kabin') {
                                    $query->whereRaw('LOWER(name) LIKE ?', ['%kabin%']);
                                } elseif ($search === 'pineus') {
                                    $query->whereRaw('LOWER(name) LIKE ?', ['%pineus%']);
                                } elseif ($search === 'tilu') {
                                    $query->whereRaw('LOWER(name) LIKE ?', ['%tilu%']);
                                }
                                // Search kombinasi kata
                                elseif (str_contains($search, 'pineus') && str_contains($search, '1')) {
                                    $query->whereRaw('LOWER(name) LIKE ?', ['%pineus tilu i'])
                                          ->whereRaw('LOWER(name) NOT LIKE ?', ['%pineus tilu ii%']);
                                } elseif (str_contains($search, 'pineus') && str_contains($search, '2')) {
                                    $query->whereRaw('LOWER(name) LIKE ?', ['%pineus tilu ii'])
                                          ->whereRaw('LOWER(name) NOT LIKE ?', ['%pineus tilu iii%']);
                                } elseif (str_contains($search, 'pineus') && str_contains($search, '3')) {
                                    $query->whereRaw('LOWER(name) LIKE ?', ['%pineus tilu iii%']);
                                } elseif (str_contains($search, 'pineus') && str_contains($search, '4')) {
                                    $query->whereRaw('LOWER(name) LIKE ?', ['%pineus tilu iv%']);
                                }
                                // Search kombinasi VIP
                                elseif (str_contains($search, 'vip') && str_contains($search, 'tenda')) {
                                    $query->whereRaw('LOWER(name) LIKE ?', ['%vip%'])
                                          ->whereRaw('LOWER(name) LIKE ?', ['%tenda%']);
                                } elseif (str_contains($search, 'vip') && str_contains($search, 'kabin')) {
                                    $query->whereRaw('LOWER(name) LIKE ?', ['%vip%'])
                                          ->whereRaw('LOWER(name) LIKE ?', ['%kabin%']);
                                }
                                // Default case-insensitive search untuk phrase lengkap
                                else {
                                    $query->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"]);
                                }
                            });
                        }
                    )
                    ->size('sm')
                    ->weight('medium')
                    ->wrap()
                    ->description(fn (Area $record): string => 
                        'ID: ' . $record->id . ' • ' . 
                        'Unit: ' . AreaUnit::where('area_id', $record->id)->count() . ' deck'
                    ),
                
                Tables\Columns\TextColumn::make('weekday_price')
                    ->label('Harga Weekday')
                    ->money('IDR')
                    ->size('sm')
                    ->color('primary')
                    ->getStateUsing(function (Area $record) {
                        $areaUnit = AreaUnit::where('area_id', $record->id)->first();
                        if (!$areaUnit) return null;
                        
                        $price = Price::where('unit_id', $areaUnit->id)->first();
                        return $price ? $price->weekday : null;
                    })
                    ->placeholder('-')
                    ->sortable(false),
                
                Tables\Columns\TextColumn::make('weekend_price')
                    ->label('Harga Weekend')
                    ->money('IDR')
                    ->size('sm')
                    ->color('warning')
                    ->getStateUsing(function (Area $record) {
                        $areaUnit = AreaUnit::where('area_id', $record->id)->first();
                        if (!$areaUnit) return null;
                        
                        $price = Price::where('unit_id', $areaUnit->id)->first();
                        return $price ? $price->weekend : null;
                    })
                    ->placeholder('-')
                    ->sortable(false),
                
                Tables\Columns\TextColumn::make('high_season_price')
                    ->label('Harga High Season')
                    ->money('IDR')
                    ->size('sm')
                    ->color('danger')
                    ->getStateUsing(function (Area $record) {
                        $areaUnit = AreaUnit::where('area_id', $record->id)->first();
                        if (!$areaUnit) return null;
                        
                        $price = Price::where('unit_id', $areaUnit->id)->first();
                        return $price ? $price->highseason : null;
                    })
                    ->placeholder('-')
                    ->sortable(false),
                
                Tables\Columns\TextColumn::make('extra_charge')
                    ->label('Extra Charge')
                    ->money('IDR')
                    ->size('sm')
                    ->color('info')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->since()
                    ->size('sm')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('area_type')
                    ->label('Filter Area')
                    ->options([
                        'Pineus Tilu I' => 'Pineus Tilu I',
                        'Pineus Tilu II' => 'Pineus Tilu II',
                        'Pineus Tilu III VIP (Tenda)' => 'Pineus Tilu III VIP (Tenda)',
                        'Pineus Tilu III VIP (Kabin)' => 'Pineus Tilu III VIP (Kabin)',
                        'Pineus Tilu IV' => 'Pineus Tilu IV',
                    ])
                    ->attribute('name')
                    ->multiple()
                    ->searchable()
                    ->preload(),
                
                Tables\Filters\Filter::make('has_price')
                    ->label('Memiliki Harga')
                    ->query(function ($query) {
                        return $query->whereHas('units', function ($query) {
                            $query->whereHas('price');
                        });
                    })
                    ->toggle(),
                    
                Tables\Filters\Filter::make('vip_area')
                    ->label('Area VIP')
                    ->query(function ($query) {
                        return $query->where('name', 'like', '%VIP%');
                    })
                    ->toggle(),
                    
                Tables\Filters\Filter::make('regular_area')
                    ->label('Area Reguler')
                    ->query(function ($query) {
                        return $query->where('name', 'not like', '%VIP%');
                    })
                    ->toggle(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->label('Lihat Detail')
                        ->icon('heroicon-o-eye')
                        ->color('info'),
                        
                    Tables\Actions\EditAction::make()
                        ->label('Edit Area')
                        ->icon('heroicon-o-pencil')
                        ->color('warning'),
                        
                    Tables\Actions\DeleteAction::make()
                        ->label('Hapus Area')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->modalHeading('Hapus Area')
                        ->modalDescription('Apakah Anda yakin ingin menghapus area ini? Data yang terkait akan ikut terhapus.')
                        ->modalSubmitActionLabel('Ya, Hapus'),
                ])
                ->label('Aksi')
                ->icon('heroicon-m-ellipsis-vertical')
                ->size('sm')
                ->color('gray')
                ->button(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->requiresConfirmation()
                        ->modalHeading('Hapus Area Terpilih')
                        ->modalDescription('Apakah Anda yakin ingin menghapus semua area yang dipilih?')
                        ->modalSubmitActionLabel('Ya, Hapus Semua'),
                ]),
            ])
            ->defaultSort('id', 'asc')
            ->striped()
            ->paginated([10, 25, 50])
            ->defaultPaginationPageOption(10)
            ->persistSortInSession()
            ->persistSearchInSession()
            ->persistFiltersInSession()
            ->searchPlaceholder('Cari: 1=Tilu I, 2=Tilu II, 3=Tilu III, 4=Tilu IV, VIP, Tenda, Kabin...')
            ->searchDebounce('500ms')
            ->deferLoading()
            ->poll('30s')
            ->emptyStateHeading('Tidak Ada Area')
            ->emptyStateDescription('Belum ada area yang tersedia dalam sistem.')
            ->emptyStateIcon('heroicon-o-building-office');
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
            'index' => Pages\ListFasilitas::route('/'),
            'view' => Pages\ViewFasilitas::route('/{record}'),
            'edit' => Pages\EditFasilitas::route('/{record}/edit'),
        ];
    }
    
    // Disable create page
    public static function canCreate(): bool
    {
        return false;
    }
    
    // Global search dengan custom logic
    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['units']);
    }
    
    public static function getGlobalSearchResultTitle(Model $record): string
    {
        return $record->name;
    }
    
    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Area' => $record->name,
            'Extra Charge' => 'Rp ' . number_format($record->extra_charge ?? 0, 0, ',', '.'),
        ];
    }
    
    public static function getGloballySearchableAttributes(): array
    {
        return ['name'];
    }
    
    // Custom global search logic
    public static function getGlobalSearchResultActions(Model $record): array
    {
        return [
            Tables\Actions\Action::make('view')
                ->label('Lihat')
                ->icon('heroicon-o-eye')
                ->url(static::getUrl('view', ['record' => $record])),
            Tables\Actions\Action::make('edit')
                ->label('Edit')
                ->icon('heroicon-o-pencil')
                ->url(static::getUrl('edit', ['record' => $record])),
        ];
    }
}