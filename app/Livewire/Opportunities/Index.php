<?php

namespace App\Livewire\Opportunities;

use App\Helpers\Table\Header;
use App\Models\Opportunity;
use App\Traits\Livewire\HasTable;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\{Component, WithPagination};

class Index extends Component
{
    use WithPagination;
    use HasTable;

    public bool $searchTrash = false;

    #[On('opportunity::reload')]
    public function render(): View
    {
        return view('livewire.opportunities.index');
    }

    public function query(): Builder
    {
        return Opportunity::query()->when($this->searchTrash, fn (Builder $q) => $q->onlyTrashed());
    }

    public function searchColumns(): array
    {
        return ['title', 'status'];
    }

    public function tableHeaders(): array
    {
        return [
            Header::make('id', '#'),
            Header::make('title', 'Title'),
            Header::make('status', 'Status'),
            Header::make('amount', 'Amount'),
        ];
    }
}
