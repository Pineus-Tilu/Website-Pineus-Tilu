<?php

namespace App\Filament\Resources\FasilitasResource\Pages;

use App\Filament\Resources\FasilitasResource;
use App\Models\AreaUnit;
use App\Models\Price;
use App\Models\Facility;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;

class EditFasilitas extends EditRecord
{
    protected static string $resource = FasilitasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            // Actions\DeleteAction::make(),
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Area')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Area')
                            ->disabled()
                            ->dehydrated(false),

                        Forms\Components\TextInput::make('tipe_area')
                            ->label('Tipe Fasilitas')
                            ->disabled()
                            ->dehydrated(false),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Fasilitas Pribadi')
                    ->schema([
                        Forms\Components\Repeater::make('fasilitas_pribadi')
                            ->label('')
                            ->schema([
                                Forms\Components\Textarea::make('description')
                                    ->label('Deskripsi Fasilitas')
                                    ->required()
                                    ->rows(2)
                                    ->columnSpanFull(),

                                Forms\Components\Hidden::make('type')
                                    ->default('pribadi'),

                                Forms\Components\Hidden::make('area_id')
                                    ->default(fn($livewire) => $livewire->record->id),
                            ])
                            ->defaultItems(0)
                            ->addActionLabel('Tambah Fasilitas Pribadi')
                            ->deleteAction(
                                fn(Forms\Components\Actions\Action $action) => $action
                                    ->requiresConfirmation()
                                    ->modalHeading('Hapus Fasilitas')
                                    ->modalDescription('Apakah Anda yakin ingin menghapus fasilitas ini?')
                                    ->modalSubmitActionLabel('Ya, Hapus')
                            )
                            ->reorderable()
                            ->cloneable()
                            ->collapsible()
                            ->itemLabel(fn(array $state): ?string => $state['description'] ?? null),
                    ])
                    ->collapsible()
                    ->collapsed(false),

                Forms\Components\Section::make('Fasilitas Umum')
                    ->schema([
                        Forms\Components\Repeater::make('fasilitas_umum')
                            ->label('')
                            ->schema([
                                Forms\Components\Textarea::make('description')
                                    ->label('Deskripsi Fasilitas')
                                    ->required()
                                    ->rows(2)
                                    ->columnSpanFull(),

                                Forms\Components\Hidden::make('type')
                                    ->default('umum'),

                                Forms\Components\Hidden::make('area_id')
                                    ->default(fn($livewire) => $livewire->record->id),
                            ])
                            ->defaultItems(0)
                            ->addActionLabel('Tambah Fasilitas Umum')
                            ->deleteAction(
                                fn(Forms\Components\Actions\Action $action) => $action
                                    ->requiresConfirmation()
                                    ->modalHeading('Hapus Fasilitas')
                                    ->modalDescription('Apakah Anda yakin ingin menghapus fasilitas ini?')
                                    ->modalSubmitActionLabel('Ya, Hapus')
                            )
                            ->reorderable()
                            ->cloneable()
                            ->collapsible()
                            ->itemLabel(fn(array $state): ?string => $state['description'] ?? null),
                    ])
                    ->collapsible()
                    ->collapsed(false),

                Forms\Components\Section::make('Pengaturan yang Dapat Diubah')
                    ->schema([
                        Forms\Components\TextInput::make('jumlah_unit')
                            ->label('Jumlah Area Unit')
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->maxValue(50)
                            ->helperText('Mengubah jumlah unit akan menambah atau mengurangi deck yang tersedia')
                            ->live()
                            ->afterStateUpdated(function ($state, $record) {
                                if ($record) {
                                    $currentCount = AreaUnit::where('area_id', $record->id)->count();
                                    if ($state != $currentCount) {
                                        Notification::make()
                                            ->title('Perhatian')
                                            ->body("Jumlah unit akan diubah dari {$currentCount} menjadi {$state}")
                                            ->warning()
                                            ->send();
                                    }
                                }
                            }),

                        Forms\Components\TextInput::make('extra_charge')
                            ->label('Extra Charge')
                            ->numeric()
                            ->prefix('Rp')
                            ->required()
                            ->minValue(0),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Pengaturan Harga')
                    ->schema([
                        Forms\Components\TextInput::make('harga_weekday')
                            ->label('Harga Weekday')
                            ->numeric()
                            ->prefix('Rp')
                            ->required()
                            ->minValue(0),

                        Forms\Components\TextInput::make('harga_weekend')
                            ->label('Harga Weekend')
                            ->numeric()
                            ->prefix('Rp')
                            ->required()
                            ->minValue(0),

                        Forms\Components\TextInput::make('harga_highseason')
                            ->label('Harga High Season')
                            ->numeric()
                            ->prefix('Rp')
                            ->required()
                            ->minValue(0),
                    ])
                    ->columns(3),
            ]);
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        // Update area record
        $record->update([
            'extra_charge' => $data['extra_charge'],
        ]);

        // Handle fasilitas pribadi update
        if (isset($data['fasilitas_pribadi'])) {
            // Hapus fasilitas pribadi yang lama
            Facility::where('area_id', $record->id)->where('type', 'pribadi')->delete();

            // Tambah fasilitas pribadi yang baru
            foreach ($data['fasilitas_pribadi'] as $facility) {
                if (!empty($facility['description'])) {
                    Facility::create([
                        'area_id' => $record->id,
                        'description' => $facility['description'],
                        'type' => 'pribadi',
                    ]);
                }
            }
        }

        // Handle fasilitas umum update
        if (isset($data['fasilitas_umum'])) {
            // Hapus fasilitas umum yang lama
            Facility::where('area_id', $record->id)->where('type', 'umum')->delete();

            // Tambah fasilitas umum yang baru
            foreach ($data['fasilitas_umum'] as $facility) {
                if (!empty($facility['description'])) {
                    Facility::create([
                        'area_id' => $record->id,
                        'description' => $facility['description'],
                        'type' => 'umum',
                    ]);
                }
            }
        }

        // Handle jumlah unit update
        if (isset($data['jumlah_unit'])) {
            $currentUnits = AreaUnit::where('area_id', $record->id)->get();
            $currentCount = $currentUnits->count();
            $newCount = (int) $data['jumlah_unit'];

            if ($newCount > $currentCount) {
                // Tambah unit baru
                $existingUnit = $currentUnits->first();
                for ($i = $currentCount + 1; $i <= $newCount; $i++) {
                    $newUnit = AreaUnit::create([
                        'area_id' => $record->id,
                        'unit_name' => 'Deck ' . $i,
                        'default_people' => $existingUnit ? $existingUnit->default_people : 4,
                        'max_people' => $existingUnit ? $existingUnit->max_people : 6,
                    ]);

                    // Create price for new unit
                    Price::create([
                        'unit_id' => $newUnit->id,
                        'weekday' => $data['harga_weekday'] ?? 0,
                        'weekend' => $data['harga_weekend'] ?? 0,
                        'highseason' => $data['harga_highseason'] ?? 0,
                    ]);
                }
            } elseif ($newCount < $currentCount) {
                // Hapus unit berlebih (mulai dari yang terakhir)
                $unitsToDelete = $currentUnits->sortByDesc('id')->take($currentCount - $newCount);
                foreach ($unitsToDelete as $unit) {
                    // Hapus price terlebih dahulu
                    Price::where('unit_id', $unit->id)->delete();
                    // Kemudian hapus unit
                    $unit->delete();
                }
            }
        }

        // Update prices for all units
        $units = AreaUnit::where('area_id', $record->id)->get();
        foreach ($units as $unit) {
            $price = Price::where('unit_id', $unit->id)->first();
            if ($price) {
                $price->update([
                    'weekday' => $data['harga_weekday'] ?? $price->weekday,
                    'weekend' => $data['harga_weekend'] ?? $price->weekend,
                    'highseason' => $data['harga_highseason'] ?? $price->highseason,
                ]);
            } else {
                Price::create([
                    'unit_id' => $unit->id,
                    'weekday' => $data['harga_weekday'] ?? 0,
                    'weekend' => $data['harga_weekend'] ?? 0,
                    'highseason' => $data['harga_highseason'] ?? 0,
                ]);
            }
        }

        Notification::make()
            ->title('Berhasil!')
            ->body('Data area dan fasilitas telah diperbarui')
            ->success()
            ->send();

        return $record;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('view', ['record' => $this->getRecord()]);
    }

    // Method untuk load data fasilitas saat form dimuat
    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Load fasilitas pribadi
        $fasilitasPribadi = Facility::where('area_id', $this->record->id)
            ->where('type', 'pribadi')
            ->get()
            ->map(function ($facility) {
                return [
                    'id' => $facility->id,
                    'description' => $facility->description,
                    'type' => $facility->type,
                    'area_id' => $facility->area_id,
                ];
            })
            ->toArray();

        // Load fasilitas umum
        $fasilitasUmum = Facility::where('area_id', $this->record->id)
            ->where('type', 'umum')
            ->get()
            ->map(function ($facility) {
                return [
                    'id' => $facility->id,
                    'description' => $facility->description,
                    'type' => $facility->type,
                    'area_id' => $facility->area_id,
                ];
            })
            ->toArray();

        // Load jumlah unit
        $jumlahUnit = AreaUnit::where('area_id', $this->record->id)->count();

        // Load harga dari price table
        $areaUnit = AreaUnit::where('area_id', $this->record->id)->first();
        $hargaWeekday = 0;
        $hargaWeekend = 0;
        $hargaHighseason = 0;

        if ($areaUnit) {
            $price = Price::where('unit_id', $areaUnit->id)->first();
            if ($price) {
                $hargaWeekday = $price->weekday;
                $hargaWeekend = $price->weekend;
                $hargaHighseason = $price->highseason;
            }
        }

        // Set tipe area berdasarkan fasilitas yang ada
        $facilities = Facility::where('area_id', $this->record->id)->pluck('type')->unique();
        $tipeArea = 'Belum ada fasilitas';
        
        if (!$facilities->isEmpty()) {
            if ($facilities->count() === 1) {
                $tipeArea = ucfirst($facilities->first());
            } else {
                $tipeArea = 'Pribadi & Umum';
            }
        }

        // Set data ke form
        $data['fasilitas_pribadi'] = $fasilitasPribadi;
        $data['fasilitas_umum'] = $fasilitasUmum;
        $data['jumlah_unit'] = $jumlahUnit;
        $data['harga_weekday'] = $hargaWeekday;
        $data['harga_weekend'] = $hargaWeekend;
        $data['harga_highseason'] = $hargaHighseason;
        $data['tipe_area'] = $tipeArea; // Tambah ini untuk set nilai tipe_area

        return $data;
    }
}