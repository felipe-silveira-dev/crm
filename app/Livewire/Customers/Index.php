<?php

namespace App\Livewire\Customers;

use App\Helpers\Table\Header;
use App\Models\Customer;
use App\Traits\Livewire\HasTable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\{Component, WithPagination};

/**
 * @property-read LengthAwarePaginator $customers
 */
class Index extends Component
{
    use WithPagination;
    use HasTable;

    public function render(): View
    {
        return view('livewire.customers.index');
    }

    #[Computed]
    public function customers(): LengthAwarePaginator
    {
        return Customer::query()
        ->when(
            $this->search,
            fn (Builder $q) => $q->where(DB::raw('lower(name)'), 'like', '%' . strtolower($this->search) . '%')
            ->orWhere('email', 'like', '%' . strtolower($this->search) . '%')
        )
        ->orderBy($this->sortColumnBy, $this->sortDirection)
        ->paginate($this->perPage);
    }

    public function tableHeaders(): array
    {
        return [
            Header::make('id', '#'),
            Header::make('name', 'Name'),
            Header::make('email', 'Email'),
        ];
    }
}
