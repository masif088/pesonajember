<?php

namespace App\Livewire\Spatie;


use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSetPermission extends Component
{
    public $optionPermission;
    public $optionRole;
    public $role;
    public $permission;

    public function mount()
    {
        $this->optionPermission = [];
        foreach (Permission::all() as $p) {
            $this->optionPermission[] = ['value' => $p['name'], 'title' => $p['name']];
        }
        $this->optionRole = [];
        foreach (Role::all() as $p) {
            $this->optionRole[] = ['value' => $p['name'], 'title' => $p['name']];
        }
    }
    public function create()
    {
        $role = Role::findByName($this->role);
        $role->givePermissionTo($this->permission);

        $this->dispatch('swal:alert', data: [
            'icon' => 'success',
            'title' => 'Berhasil menambahkan izin ke '.$this->role,
        ]);
    }

    public function render()
    {
        return view('livewire.spatie.role-set-permission');
    }
}
