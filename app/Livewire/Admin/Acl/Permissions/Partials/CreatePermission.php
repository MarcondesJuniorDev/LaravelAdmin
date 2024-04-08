<?php

namespace App\Livewire\Admin\Acl\Permissions\Partials;

use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;

class CreatePermission extends Component
{
    public $showModal = false;
    public $name;

    public function toggleModal(): void
    {
        $this->resetValidation();
        $this->showModal = !$this->showModal;
    }

    public function render(): View
    {
        return view('livewire.admin.acl.permissions.partials.create-permission');
    }

    public function submit()
    {
        $validatedData = $this->validate([
            'name' => 'required|unique:permissions',
        ]);

        $validatedData['slug'] = Str::slug($validatedData['name']);

        Permission::create($validatedData);

        session()->flash('message', 'Permissão Criada com Sucesso.');

        $this->toggleModal();

        return redirect()->route('admin.permissions');
    }
}
