<?php

namespace App\Livewire\Spatie;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSetRole extends Component
{
    public $optionPermission;

    public $optionUser;

    public $optionRole;

    public $role;

    public $user;

    public $permission;

    public function mount()
    {
        $this->optionUser = eloquent_to_options(User::get(), 'id', 'name');
        $this->optionRole = [];
        foreach (Role::all() as $p) {
            $this->optionRole[] = ['value' => $p['name'], 'title' => $p['name']];
        }
    }

    public function create()
    {
        $user = User::find($this->user);
        $this->role = Role::findByName($this->role, 'sanctum');
        $user->assignRole($this->role);
        //        $role = Role::findByName($this->role);
        //        $role->givePermissionTo($this->permission);

        $this->dispatch('swal:alert', data: [
            'icon' => 'success',
            'title' => 'Berhasil menambahkan role ke '.$user->name,
        ]);
    }

    public function render()
    {
        return view('livewire.spatie.user-set-role');
    }
}
