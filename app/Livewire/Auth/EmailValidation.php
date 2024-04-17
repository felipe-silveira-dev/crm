<?php

namespace App\Livewire\Auth;

use Closure;
use Livewire\Component;

class EmailValidation extends Component
{
    public ?string $code = null;

    public function render()
    {
        return view('livewire.auth.email-validation');
    }

    public function handle(): void
    {
        $this->validate([
            'code' => function (string $attribute, mixed $value, Closure $fail) {
                if (auth()->user()->validation_code !== $value) {
                    $fail('Invalid code');
                }
            },
        ]);
    }
}
