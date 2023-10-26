<?php

namespace App\Livewire\Admin\Users;

use App\Enums\Can;
use App\Models\{Permission, User};
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\{Builder, Collection};
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    public ?string $search = null;

    public array $search_permissions = [];

    public bool $search_trash = false;

    public Collection $permissionsToSearch;

    public function mount(): void
    {
        $this->authorize(Can::BE_AN_ADMIN->value);
        $this->searchPermissions();
    }

    public function render(): View
    {
        return view('livewire.admin.users.index');
    }

    #[Computed]
    public function users(): LengthAwarePaginator
    {
        $this->validate(['search_permissions' => 'exists:permissions,id']);

        return User::query()
        ->when(
            $this->search,
            fn (Builder $q) => $q->where(
                DB::raw('lower(name)'), /** @phpstan-ignore-line */
                'like',
                '%' . strtolower($this->search) . '%'
            )
            ->orWhere(
                'email',
                'like',
                '%' . strtolower($this->search) . '%'
            )
        )
        ->when(
            $this->search_permissions,
            fn (Builder $q) => $q->whereHas(
                'permissions',
                fn (Builder $q) => $q->whereIn('id', $this->search_permissions)
            )
        )
        ->when($this->search_trash, fn (Builder $q) => $q->onlyTrashed()) /** @phpstan-ignore-line */
        ->paginate(10);
    }

    #[Computed]
    public function headers(): array
    {
        return [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'name', 'label' => 'Name'],
            ['key' => 'email', 'label' => 'Email'],
            ['key' => 'permissions', 'label' => 'Permissions'],
            ['key' => 'actions', 'label' => 'Actions'],
        ];
    }

    public function searchPermissions(?string $value = null): void
    {
        $this->permissionsToSearch = Permission::query()
                ->when(
                    $value,
                    fn (Builder $q) => $q->where(
                        'key',
                        '%' . $value . '%'
                    )
                )
                ->orderBy('key')
                ->get();
    }
}
