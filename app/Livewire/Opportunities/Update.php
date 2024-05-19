<?php

namespace App\Livewire\Opportunities;

use App\Models\{Customer, Opportunity};
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\{Computed, On};
use Livewire\Component;

class Update extends Component
{
    public Form $form;

    public bool $modal = false;

    public function render(): View
    {
        return view('livewire.opportunities.update');
    }

    #[Computed('customers')]
    public function customers(): Collection
    {
        return Customer::query()
                ->select('id', 'name')
                ->get();
    }

    #[On('opportunity::update')]
    public function load(int $opportunityId): void
    {
        $opportunity = Opportunity::query()->whereId($opportunityId)->firstOrFail();
        $this->form->setOpportunity($opportunity);
        $this->form->resetErrorBag();
        $this->search();
        $this->modal = true;
    }

    public function save(): void
    {
        $this->validate();

        $this->form->update();

        $this->modal = false;
        $this->dispatch('opportunity::reload')->to('opportunities.index');
    }

    public function search(string $value = ''): void
    {
        $this->form->searchCustomers($value);
    }
}
