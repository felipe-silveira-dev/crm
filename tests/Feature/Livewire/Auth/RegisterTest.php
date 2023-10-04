<?php

use App\Livewire\Auth\Register;
use Livewire\Livewire;

use function Pest\Laravel\{assertDatabaseCount, assertDatabaseHas};

it('should render the component', function () {
    {
        Livewire::test(Register::class)
            ->assertStatus(200);
    }
});

it('should be able to register', function () {
    Livewire::test(Register::class)
        ->set('name', 'John Doe')
        ->set('email', 'jhon@doe.com')
        ->set('email_confirmation', 'jhon@doe.com')
        ->set('password', 'password')
        ->call('submit')
        ->assertHasNoErrors();

    assertDatabaseHas('users', [
        'name'  => 'John Doe',
        'email' => 'jhon@doe.com',
    ]);

    assertDatabaseCount('users', 1);
});
