<?php

namespace App\Livewire\Admin\Acl\Roles;

use App\Models\Role;
use Illuminate\View\View;
use Livewire\Component;

class RolesTable extends Component
{
    public string $term = '';

    protected $listeners = ['termRoles'];

    public function termRoles(string $search): void
    {
        $this->term = $search;
    }

    public function render(): View
    {
        $roles = Role::query()
            ->whereAny(['name', 'slug'], 'LIKE', "%{$this->term}%")
            ->orderByDesc('created_at')
            ->paginate(10);
        return view('livewire.admin.acl.roles.roles-table', compact('roles'));
    }
}
