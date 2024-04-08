<?php

namespace App\Livewire\Admin\Acl\Permissions;

use App\Models\Permission;
use Illuminate\View\View;
use Livewire\Component;

class PermissionsTable extends Component
{
    public string $term = '';

    protected $listeners = ['termPermissions'];

    public function termPermissions(string $search): void
    {
        $this->term = $search;
    }

    public function render(): View
    {
        $permissions = Permission::query()
            ->whereAny(['name'], 'LIKE', "%{$this->term}%")
            ->orderByDesc('created_at')
            ->paginate(10);
        return view('livewire.admin.acl.permissions.permissions-table', compact('permissions'));
    }
}
