<?php

namespace App\Livewire\Opportunities;

use App\Models\{Opportunity};
use Illuminate\Contracts\View\View;
use Livewire\Attributes\{On};
use Livewire\Component;
use Mary\Traits\Toast;

class Update extends Component
{
    use Toast;

    public Form $form;
    public bool $modal = false;

    public function render(): View
    {
        return view('livewire.opportunities.update');
    }

    #[On('opportunity::update')]
    public function load(int $opportunityId): void
    {
        $opportunity = Opportunity::query()->whereId($opportunityId)->firstOrFail();
        $this->form->setOpportunity($opportunity);
        $this->form->resetErrorBag();
        $this->modal = true;
    }

    public function save(): void
    {
        $this->form->update();

        $this->modal = false;
        $this->success(__('Updated successfully.'));
        $this->dispatch('opportunity::reload')->to('opportunities.index');
    }

    public function search(string $value = ''): void
    {
        $this->form->searchCustomers($value);
    }
}
