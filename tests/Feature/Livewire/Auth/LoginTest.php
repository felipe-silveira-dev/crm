<?php

use App\Livewire\Auth\Login;
use App\Models\User;
use Livewire\Livewire;

it('should render the component', function () {
    Livewire::test(Login::class)
            ->assertOk();
});

it('should be able to login', function () {
    $user = User::factory()->create([
        'email'    => 'joe@doe.com',
        'password' => 'password',
    ]);

    Livewire::test(Login::class)
            ->set('email', 'joe@doe.com')
            ->set('password', 'password')
            ->call('tryToLogin')
            ->assertHasNoErrors()
            ->assertRedirect(route('dashboard'));

    expect(auth()->user()->id)->toEqual($user->id);
    expect(auth()->check())->toBeTrue();
});
