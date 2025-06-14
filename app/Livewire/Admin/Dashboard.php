<?php declare(strict_types = 1);

namespace App\Livewire\Admin;

use App\Enums\Can;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Dashboard extends Component
{
    public function mount(): void
    {
        $this->authorize(Can::BE_AN_ADMIN->value);
    }

    public function render(): View
    {
        return view('livewire.admin.dashboard');
    }
}
