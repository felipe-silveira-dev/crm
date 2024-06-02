<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Quill extends Component
{
    public string $quillId;

    public ?string $value = null;

    public function mount(string $quillId, string $value = null): void
    {
        $this->quillId = $quillId;
        $this->value   = $value;
    }

    public function updatedValue(): void
    {
        $this->dispatch('teste-cabuloso', $this->value);
    }

    public function render(): View
    {
        return view('livewire.quill');
    }
}
