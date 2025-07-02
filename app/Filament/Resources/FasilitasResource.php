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
                Tables\Columns\TextColumn::make('area.name')
                    ->label('Area')
                    ->sortable()
                    ->searchable(),
                
                Tables\Columns\BadgeColumn::make('type')
                    ->label('Tipe')
                    ->colors([
                        'success' => 'pribadi',
                        'warning' => 'umum',
                    ])
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 50 ? $state : null;
                    }),
                
                Tables\Columns\TextColumn::make('weekday_price')
                    ->label('Harga Weekday')
                    ->money('IDR')
                    ->getStateUsing(function (Facility $record) {
                        // Ambil area units berdasarkan area yang sama dengan facility
                        $areaUnit = AreaUnit::where('area_id', $record->area_id)->first();
                        if (!$areaUnit) {
                            return null;
                        }
                        
                        $price = Price::where('unit_id', $areaUnit->id)->first();
                        if (!$price) {
                            return null;
                        }
                        
                        return $price->weekday;
                    })
                    ->placeholder('Belum ada harga'),
                
                Tables\Columns\TextColumn::make('weekend_price')
                    ->label('Harga Weekend')
                    ->money('IDR')
                    ->getStateUsing(function (Facility $record) {
                        // Ambil area units berdasarkan area yang sama dengan facility
                        $areaUnit = AreaUnit::where('area_id', $record->area_id)->first();
                        if (!$areaUnit) {
                            return null;
                        }
                        
                        $price = Price::where('unit_id', $areaUnit->id)->first();
                        if (!$price) {
                            return null;
                        }
                        
                        return $price->weekend;
                    })
                    ->placeholder('Belum ada harga'),
                
                Tables\Columns\TextColumn::make('high_season_price')
                    ->label('Harga High Season')
                    ->money('IDR')
                    ->getStateUsing(function (Facility $record) {
                        // Ambil area units berdasarkan area yang sama dengan facility
                        $areaUnit = AreaUnit::where('area_id', $record->area_id)->first();
                        if (!$areaUnit) {
                            return null;
                        }
                        
                        $price = Price::where('unit_id', $areaUnit->id)->first();
                        if (!$price) {
                            return null;
                        }
                        
                        return $price->highseason;
                    })
                    ->placeholder('Belum ada harga'),
                
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Gambar')
                    ->circular()
                    ->height(50),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('area_id')
                    ->label('Area')
                    ->options(Area::all()->pluck('name', 'id')),
                
                Tables\Filters\SelectFilter::make('type')
                    ->label('Tipe')
                    ->options([
                        'pribadi' => 'Pribadi',
                        'umum' => 'Umum',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                
                // Hapus atau ganti action ini karena route tidak ada
                Tables\Actions\Action::make('view_area_units')
                    ->label('Lihat Area Units')
                    ->icon('heroicon-o-building-office-2')
                    ->action(function (Facility $record) {
                        // Redirect ke halaman area units berdasarkan area_id
                        return redirect()->route('filament.admin.resources.area-units.index', [
                            'tableFilters' => [
                                'area_id' => ['value' => $record->area_id]
                            ]
                        ]);
                    })
                    ->visible(fn (Facility $record) => $record->area_id !== null),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            // Jika ingin menambahkan relasi manager untuk units
            // RelationManagers\UnitsRelationManager::class,
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