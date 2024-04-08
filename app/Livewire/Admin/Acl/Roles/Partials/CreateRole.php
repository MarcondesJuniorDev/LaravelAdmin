<?php

namespace App\Livewire\Admin\Acl\Roles\Partials;

use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;

class CreateRole extends Component
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
        return view('livewire.admin.acl.roles.partials.create-role');
    }

    public function submit()
    {
        $validatedData = $this->validate([
            'name' => 'required|unique:roles',
        ]);

        $validatedData['slug'] = Str::slug($validatedData['name']);

        Role::create($validatedData);

        session()->flash('message', 'Função Criada com Sucesso.');

        $this->toggleModal();

        return redirect()->route('admin.roles');
    }
}
