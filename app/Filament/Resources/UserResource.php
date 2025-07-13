<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Models\Role;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Users';
    protected static ?string $pluralModelLabel = 'Users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi User')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nama')
                                    ->required()
                                    ->maxLength(255)
                                    ->disabled(fn ($record, $context) => ($record && !is_null($record->google_id)) || $context === 'view'),

                                Forms\Components\TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->required()
                                    ->unique(User::class, 'email', ignoreRecord: true)
                                    ->maxLength(255)
                                    ->disabled(fn ($record, $context) => ($record && !is_null($record->google_id)) || $context === 'view'),
                            ]),

                        Forms\Components\TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $context): bool => $context === 'create')
                            ->minLength(8)
                            ->disabled(fn ($record) => $record && !is_null($record->google_id))
                            ->helperText(fn ($record) => 
                                $record && !is_null($record->google_id) 
                                    ? 'Password tidak dapat diubah untuk pengguna Google' 
                                    : 'Kosongkan jika tidak ingin mengubah password'
                            )
                            ->visible(fn (string $context): bool => $context !== 'view'), // Hide password in view mode
                    ]),

                Forms\Components\Section::make('Role & Permissions')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('roles')
                                    ->label('Role')
                                    ->relationship('roles', 'name')
                                    ->preload()
                                    ->searchable()
                                    ->disabled(fn (string $context): bool => $context === 'view')
                                    ->dehydrated(fn (string $context): bool => $context !== 'view')
                                    ->helperText('Pilih role untuk user ini'),

                                Forms\Components\TextInput::make('google_id')
                                    ->label('Google ID')
                                    ->disabled()
                                    ->helperText('ID Google untuk login via Google')
                                    ->visible(fn ($record) => $record && !is_null($record->google_id)),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable()
                    ->copyable(),

                // ✅ TAMPILKAN ROLE DI TABLE
                Tables\Columns\BadgeColumn::make('role')
                    ->label('Role')
                    ->getStateUsing(
                        fn(User $record): string =>
                        $record->getRoleNames()->first() ?? 'No Role'
                    )
                    ->colors([
                        'danger' => 'Super Admin',
                        'warning' => 'Admin',
                        'success' => 'User',
                        'gray' => 'No Role',
                    ])
                    ->icons([
                        'heroicon-o-shield-check' => 'Super Admin',
                        'heroicon-o-user-circle' => 'Admin',
                        'heroicon-o-user' => 'User',
                        'heroicon-o-question-mark-circle' => 'No Role',
                    ]),

                Tables\Columns\IconColumn::make('google_id')
                    ->label('Google')
                    ->boolean()
                    ->getStateUsing(fn(User $record): bool => !is_null($record->google_id))
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray'),

                // ✅ KOLOM VERIFIED DIHAPUS
                // Tables\Columns\IconColumn::make('email_verified_at')
                //     ->label('Verified')
                //     ->boolean()
                //     ->trueIcon('heroicon-o-check-circle')
                //     ->falseIcon('heroicon-o-x-circle')
                //     ->trueColor('success')
                //     ->falseColor('warning'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // ✅ FILTER BERDASARKAN ROLE
                Tables\Filters\SelectFilter::make('role')
                    ->label('Filter Role')
                    ->options(function () {
                        $roles = Role::all()->pluck('name', 'name')->toArray();
                        $roles['No Role'] = 'No Role';
                        return $roles;
                    })
                    ->query(function (Builder $query, array $data): Builder {
                        if (filled($data['value'])) {
                            if ($data['value'] === 'No Role') {
                                return $query->doesntHave('roles');
                            }
                            return $query->whereHas('roles', function (Builder $query) use ($data) {
                                $query->where('name', $data['value']);
                            });
                        }
                        return $query;
                    }),

                // ✅ FILTER VERIFIED JUGA DIHAPUS (OPSIONAL)
                // Tables\Filters\Filter::make('verified')
                //     ->label('Email Verified')
                //     ->query(fn (Builder $query): Builder => $query->whereNotNull('email_verified_at'))
                //     ->toggle(),

                Tables\Filters\Filter::make('google_users')
                    ->label('Google Users')
                    ->query(fn(Builder $query): Builder => $query->whereNotNull('google_id'))
                    ->toggle(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->label('Lihat Detail')
                        ->icon('heroicon-o-eye'),

                    Tables\Actions\EditAction::make()
                        ->label('Edit User')
                        ->icon('heroicon-o-pencil')
                        ->using(function (User $record, array $data): User {
                            // Update data user
                            $record->update([
                                'name' => $data['name'],
                                'email' => $data['email'],
                            ]);

                            // Update password jika diisi
                            if (filled($data['password'])) {
                                $record->update(['password' => bcrypt($data['password'])]);
                            }

                            // Update role
                            if (filled($data['role'])) {
                                $record->syncRoles([$data['role']]);
                            }

                            return $record;
                        }),

                    Tables\Actions\DeleteAction::make()
                        ->label('Hapus User')
                        ->icon('heroicon-o-trash'),
                ])
                    ->label('Aksi')
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->size('sm')
                    ->color('gray')
                    ->button(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),

                    // ✅ BULK ACTION UNTUK ASSIGN ROLE
                    Tables\Actions\BulkAction::make('assign_role')
                        ->label('Assign Role')
                        ->icon('heroicon-o-user-group')
                        ->color('warning')
                        ->form([
                            Forms\Components\Select::make('role')
                                ->label('Pilih Role')
                                ->options(Role::all()->pluck('name', 'name'))
                                ->required(),
                        ])
                        ->action(function (array $data, $records) {
                            foreach ($records as $record) {
                                $record->syncRoles([$data['role']]);
                            }
                        })
                        ->requiresConfirmation()
                        ->modalHeading('Assign Role ke User Terpilih')
                        ->modalDescription('Assign role yang sama ke semua user yang dipilih?'),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->searchPlaceholder('Cari nama atau email...');
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
