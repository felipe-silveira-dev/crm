<?php

namespace App\Livewire\Opportunities;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Board extends Component
{
    public function render(): View
    {
        return view('livewire.opportunities.board');
    }
}
