<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

trait HasPermissions
{
    public function givePermissionTo(string $key): void
    {
        $this->permissions()->firstOrCreate(['key' => $key]);

        Cache::forget($this->getPermissionCacheKey());
        Cache::remember($this->getPermissionCacheKey(), now()->addMonths(3), function () {
            return $this->permissions;
        });
    }

    public function hasPermissionTo(string $key): bool
    {
        /** @var Collection $permissions */
        $permissions = Cache::get($this->getPermissionCacheKey(), $this->permissions);

        return $permissions->contains('key', $key);
    }

    private function getPermissionCacheKey(): string
    {
        return "user:{$this->id}:permissions";
    }
}
