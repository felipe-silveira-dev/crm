<?php

use App\Livewire\Auth\Update;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

it('should be able to update my user data', function () {
    $user = User::factory()->create();
    actingAs($user);

    Livewire::test(Update::class)
        ->call('load', $user->id)
        ->set('form.name', 'John Doe')
        ->set('form.email', 'john@doe')
        ->call('save')
        ->assertHasNoErrors();

    expect($user->refresh()->name)->toBe('John Doe');
    expect($user->refresh()->email)->toBe('john@doe');
});
