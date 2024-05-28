<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Form as BaseForm;

class Form extends BaseForm
{
    public ?User $user = null;

    public string $name = '';

    public string $email = '';

    public function rules(): array
    {
        return [
            'name'  => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->user?->id, 'id')],
        ];
    }

    public function setUser(User $user): void
    {
        $this->user = $user;

        $this->name  = $user->name;
        $this->email = $user->email;
    }

    public function update(): void
    {
        $this->validate();

        $this->user->name  = $this->name;
        $this->user->email = $this->email;

        $this->user->save();
    }

    public function create(): void
    {
        $this->validate();

        User::create([
            'name'  => $this->name,
            'email' => $this->email,
        ]);

        $this->reset();
    }
}
