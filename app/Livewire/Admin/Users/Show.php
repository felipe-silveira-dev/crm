<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Show extends Component
{
    public ?User $user = null;

    public bool $modal = false;

    public function render(): View
    {
        return view('livewire.admin.users.show');
    }

    public function loadUser(int $userId): void
    {
        $this->user  = User::withTrashed()->with('deletedBy')->find($userId);
        $this->modal = true;
    }
}
