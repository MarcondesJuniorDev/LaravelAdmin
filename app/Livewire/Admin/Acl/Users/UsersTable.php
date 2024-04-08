<?php

namespace App\Livewire\Admin\Acl\Users;

use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;

class UsersTable extends Component
{
    public string $term = '';

    protected $listeners = ['termUsers'];

    public function termUsers(string $search): void
    {
        $this->term = $search;
    }

    public function render(): View
    {
        $users = User::query()
            ->whereAny(['name', 'email'], 'LIKE', "%{$this->term}%")
            ->orderByDesc('created_at')
            ->paginate(10);
        return view('livewire.admin.acl.users.users-table', compact('users'));
    }
}
