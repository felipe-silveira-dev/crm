<div>
    <x-header title="Users" separator progress-indicator />

    <div class="flex items-center mb-4 space-x-4">
        <div class="w-1/3">
            <x-input label="Search by name or email" icon="o-magnifying-glass" wire:model.live="search"
                placeholder="Search users..." />
        </div>

        <x-choices label="Permissions" wire:model.live="search_permissions" :options="$permissionsToSearch" option-label="key"
            search-function="searchPermissions" searchable />

        <x-checkbox label="Show Deleted Users" wire:model.live="search_trash" right />
    </div>

    <x-table :headers="$this->headers" :rows="$this->users">
        @scope('cell_permissions', $user)
            @foreach ($user->permissions as $permission)
                <x-badge :value="$permission->key" class="badge-primary" />
            @endforeach
        @endscope

        @scope('actions', $user)
            @unless ($user->trashed())
                <div class="flex space-x-2">
                    <x-button icon="o-pencil" wire:click="edit({{ $user->id }})" spinner class="btn-sm" />
                    <x-button icon="o-trash" wire:click="delete({{ $user->id }})" spinner class="btn-sm" />
                </div>
            @else
                <x-button icon="o-arrow-path" wire:click="restore({{ $user->id }})" spinner
                    class="btn-sm btn-success btn-ghost" />
            @endunless
        @endscope
    </x-table>
</div>
