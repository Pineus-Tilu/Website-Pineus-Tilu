<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Spatie\Permission\Models\Role;
use Filament\Forms;
use Illuminate\Support\Facades\Hash;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;
    public $roleToAssign = null;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('assign_role')
                ->label('Ubah Role')
                ->icon('heroicon-o-user-group')
                ->color('warning')
                ->form([
                    Forms\Components\Select::make('role')
                        ->label('Pilih Role Baru')
                        ->options(Role::all()->pluck('name', 'name'))
                        ->default($this->record->getRoleNames()->first())
                        ->required(),
                ])
                ->action(function (array $data) {
                    $this->record->syncRoles([$data['role']]);
                    $this->notify('success', 'Role berhasil diubah!');
                    
                    // ✅ REDIRECT KE INDEX UNTUK REFRESH TABLE
                    return redirect($this->getResource()::getUrl('index'));
                }),

            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['role'] = $this->record->getRoleNames()->first() ?? 'User';
        return $data;
    }

    // ✅ HANDLE ROLE DARI FORM JUGA
    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Handle password
        if (array_key_exists('password', $data) && filled($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        // ✅ SIMPAN ROLE UNTUK DIPROCESS SETELAH SAVE
        if (array_key_exists('role', $data)) {
            $this->roleToAssign = $data['role'];
            unset($data['role']);
        }

        return $data;
    }

    // ✅ ASSIGN ROLE SETELAH DATA USER TERSIMPAN
    protected function afterSave(): void
    {
        if ($this->roleToAssign) {
            $this->record->syncRoles([$this->roleToAssign]);
            // Refresh record untuk memastikan data terbaru
            $this->record->refresh();
        }
    }

    // ✅ REDIRECT KE INDEX SETELAH SAVE UNTUK REFRESH TABLE
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}