<?php

namespace App\Traits;

trait HasRoles
{
    public function hasRole(string $role): bool
    {
        return $this->roles()->where('name', $role)->exists();
    }

    public function hasRoles(array $slugs): bool
    {
        return $this->roles()->whereIn('name', $slugs)->exists();
    }

    public function hasPermission(string $permission): bool
    {
        return $this->permissions()->contains($permission);
    }
}
