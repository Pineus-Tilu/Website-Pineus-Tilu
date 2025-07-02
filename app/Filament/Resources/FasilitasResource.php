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
    protected static ?string $navigationLabel = 'Fasilitas';
    protected static ?string $pluralModelLabel = 'Fasilitas';

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
                    ->label('Tipe Fasilitas')
                    ->options([
                        'pribadi' => 'Pribadi',
                        'umum' => 'Umum',
                    ])
                    ->required(),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(3),
                
                Forms\Components\FileUpload::make('galeri')
                    ->label('Galeri Fasilitas')
                    ->multiple()
                    ->image()
                    ->directory('fasilitas-galeri')
                    ->maxFiles(10),
                
                Forms\Components\TextInput::make('jumlah_maksimum_orang')
                    ->label('Jumlah Maksimum Orang')
                    ->numeric(),
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
                        // Debug: tampilkan facility_id untuk memastikan
                        \Log::info('Facility ID: ' . $record->id);
                        
                        $areaUnit = AreaUnit::where('facility_id', $record->id)->first();
                        if (!$areaUnit) {
                            return 'Facility ID: ' . $record->id . ' - No Unit';
                        }
                        
                        \Log::info('Area Unit ID: ' . $areaUnit->id);
                        
                        $price = Price::where('unit_id', $areaUnit->id)->first();
                        if (!$price) {
                            return 'Unit ID: ' . $areaUnit->id . ' - No Price';
                        }
                        
                        return $price->weekday;
                    })
                    ->placeholder('Belum ada harga'),
                
                Tables\Columns\ImageColumn::make('galeri')
                    ->label('Galeri')
                    ->circular()
                    ->limit(3),
                
                Tables\Columns\TextColumn::make('jumlah_maksimum_orang')
                    ->label('Maks Orang')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
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