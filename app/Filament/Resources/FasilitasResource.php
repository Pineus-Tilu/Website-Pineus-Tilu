<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FasilitasResource\Pages;
use App\Models\Facility;
use App\Models\Area;
use App\Models\Price;
use App\Models\AreaUnit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FasilitasResource extends Resource
{
    protected static ?string $model = Facility::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationLabel = 'Area';
    protected static ?string $pluralModelLabel = 'Area';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('area_id')
                    ->label('Area')
                    ->options(Area::all()->pluck('name', 'id'))
                    ->required()
                    ->searchable(),
                
                Forms\Components\Select::make('type')
                    ->label('Tipe Area')
                    ->options([
                        'pribadi' => 'Pribadi',
                        'umum' => 'Umum',
                    ])
                    ->required(),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(3),
                
                Forms\Components\FileUpload::make('image_path')
                    ->label('Gambar Area')
                    ->image()
                    ->directory('area')
                    ->maxSize(5120), // 5MB
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Foto')
                    ->circular()
                    ->height(40)
                    ->width(40)
                    ->size('sm'),
                
                Tables\Columns\TextColumn::make('area.name')
                    ->label('Area')
                    ->sortable()
                    ->searchable()
                    ->size('sm')
                    ->weight('medium')
                    ->wrap(),
                
                Tables\Columns\BadgeColumn::make('type')
                    ->label('Tipe')
                    ->colors([
                        'success' => 'pribadi',
                        'warning' => 'umum',
                    ])
                    ->size('sm')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(30)
                    ->size('sm')
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 30 ? $state : null;
                    }),
                
                Tables\Columns\TextColumn::make('weekday_price')
                    ->label('Weekday')
                    ->money('IDR')
                    ->size('sm')
                    ->color('primary')
                    ->getStateUsing(function (Facility $record) {
                        $areaUnit = AreaUnit::where('area_id', $record->area_id)->first();
                        if (!$areaUnit) return null;
                        
                        $price = Price::where('unit_id', $areaUnit->id)->first();
                        return $price ? $price->weekday : null;
                    })
                    ->placeholder('-'),
                
                Tables\Columns\TextColumn::make('weekend_price')
                    ->label('Weekend')
                    ->money('IDR')
                    ->size('sm')
                    ->color('warning')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->getStateUsing(function (Facility $record) {
                        $areaUnit = AreaUnit::where('area_id', $record->area_id)->first();
                        if (!$areaUnit) return null;
                        
                        $price = Price::where('unit_id', $areaUnit->id)->first();
                        return $price ? $price->weekend : null;
                    })
                    ->placeholder('-'),
                
                Tables\Columns\TextColumn::make('high_season_price')
                    ->label('High Season')
                    ->money('IDR')
                    ->size('sm')
                    ->color('danger')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->getStateUsing(function (Facility $record) {
                        $areaUnit = AreaUnit::where('area_id', $record->area_id)->first();
                        if (!$areaUnit) return null;
                        
                        $price = Price::where('unit_id', $areaUnit->id)->first();
                        return $price ? $price->highseason : null;
                    })
                    ->placeholder('-'),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->since()
                    ->size('sm')
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->since()
                    ->size('sm')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('area_id')
                    ->label('Area')
                    ->options(Area::all()->pluck('name', 'id'))
                    ->multiple(),
                
                Tables\Filters\SelectFilter::make('type')
                    ->label('Tipe')
                    ->options([
                        'pribadi' => 'Pribadi',
                        'umum' => 'Umum',
                    ])
                    ->multiple(),
                
                Tables\Filters\Filter::make('with_image')
                    ->label('Dengan Gambar')
                    ->query(fn ($query) => $query->whereNotNull('image_path'))
                    ->toggle(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    
                    Tables\Actions\Action::make('view_area_units')
                        ->label('Lihat Units')
                        ->icon('heroicon-o-building-office-2')
                        ->color('info')
                        ->action(function (Facility $record) {
                            return redirect()->route('filament.admin.resources.area-units.index', [
                                'tableFilters' => [
                                    'area_id' => ['value' => $record->area_id]
                                ]
                            ]);
                        })
                        ->visible(fn (Facility $record) => $record->area_id !== null),
                    
                    Tables\Actions\DeleteAction::make(),
                ])
                ->label('Actions')
                ->icon('heroicon-m-ellipsis-vertical')
                ->size('sm')
                ->color('gray')
                ->button(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    
                    Tables\Actions\BulkAction::make('update_type')
                        ->label('Ubah Tipe')
                        ->icon('heroicon-o-pencil')
                        ->form([
                            Forms\Components\Select::make('type')
                                ->label('Tipe Baru')
                                ->options([
                                    'pribadi' => 'Pribadi',
                                    'umum' => 'Umum',
                                ])
                                ->required(),
                        ])
                        ->action(function (array $data, $records) {
                            $records->each(function ($record) use ($data) {
                                $record->update(['type' => $data['type']]);
                            });
                        })
                        ->requiresConfirmation(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated([10, 25, 50])
            ->defaultPaginationPageOption(25)
            ->persistSortInSession()
            ->persistSearchInSession()
            ->persistFiltersInSession();
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
            'create' => Pages\CreateFasilitas::route('/create'),
            'view' => Pages\ViewFasilitas::route('/{record}'),
            'edit' => Pages\EditFasilitas::route('/{record}/edit'),
        ];
    }
}