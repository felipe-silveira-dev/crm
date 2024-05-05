<?php

use App\Livewire\Customers;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas};

beforeEach(function () {
    $user = User::factory()->create();
    actingAs($user);
});

it('should create a customer', function () {
    Livewire::test(Customers\Create::class)
        ->set('name', 'John Doe')
        ->set('email', 'john@doe.com')
        ->set('phone', '1234567890')
        ->call('save')
        ->assertHasNoErrors();

    assertDatabaseHas('customers', [
        'type'  => 'customer',
        'name'  => 'John Doe',
        'email' => 'john@doe.com',
        'phone' => '1234567890',
    ]);
});

it('should require a name', function () {
    Livewire::test(Customers\Create::class)
        ->set('name', '')
        ->set('email', 'john@doe.com')
        ->set('phone', '1234567890')
        ->call('save')
        ->assertHasErrors(['name' => 'required']);

    assertDatabaseCount('customers', 0);
});

it('should require an email or phone', function () {
    Livewire::test(Customers\Create::class)
        ->set('name', 'John Doe')
        ->set('email', '')
        ->set('phone', '')
        ->call('save')
        ->assertHasErrors();

    assertDatabaseCount('customers', 0);
});

it('should require a valid email', function () {
    Livewire::test(Customers\Create::class)
        ->set('name', 'John Doe')
        ->set('email', 'invalid-email')
        ->set('phone', '')
        ->call('save')
        ->assertHasErrors(['email' => 'email']);

    assertDatabaseCount('customers', 0);
});

it('should require a unique email', function () {
    Livewire::test(Customers\Create::class)
    ->set('name', 'John Doe')
    ->set('email', 'john@doe.com')
    ->set('phone', '1234567890')
    ->call('save')
    ->assertHasNoErrors();

    Livewire::test(Customers\Create::class)
    ->set('name', 'John Doe')
    ->set('email', 'john@doe.com')
    ->set('phone', '1234567890')
    ->call('save')
    ->assertHasErrors(['email' => 'unique']);

    assertDatabaseCount('customers', 1);
});

it('should require a unique phone', function () {
    Livewire::test(Customers\Create::class)
    ->set('name', 'John Doe')
    ->set('email', 'john@doe.com')
    ->set('phone', '1234567890')
    ->call('save')
    ->assertHasNoErrors();

    Livewire::test(Customers\Create::class)
    ->set('name', 'Any Doe')
    ->set('email', 'any@doe.com')
    ->set('phone', '1234567890')
    ->call('save')
    ->assertHasErrors(['phone' => 'unique']);
});

it('should be able to create a customer without a phone', function () {
    Livewire::test(Customers\Create::class)
        ->set('name', 'John Doe')
        ->set('email', 'john@doe.com')
        ->set('phone', '')
        ->call('save')
        ->assertHasNoErrors();
});

it('should require a valid phone', function () {
    Livewire::test(Customers\Create::class)
        ->set('name', 'John Doe')
        ->set('email', 'john@doe.com')
        ->set('phone', 'invalid-phone')
        ->call('save')
        ->assertHasErrors(['phone' => 'phone']);

    assertDatabaseCount('customers', 0);
})->skip();
