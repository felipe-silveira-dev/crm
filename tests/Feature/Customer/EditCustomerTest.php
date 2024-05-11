<?php

use App\Livewire\Customers;
use App\Models\{Customer, User};
use Livewire\Livewire;

use function Pest\Laravel\{actingAs, assertDatabaseHas};

beforeEach(function () {
    actingAs(User::factory()->create());

    $this->customer = Customer::factory()->create();
});

it('should beable to update a customer', function () {
    Livewire::test(Customers\Update::class)
        ->set('customer', $this->customer)
        ->set('customer.name', 'John Doe')
        ->set('customer.email', 'john@doe.com')
        ->set('customer.phone', '1234567890')
        ->call('save')
        ->assertHasNoErrors();

    assertDatabaseHas('customers', [
        'id'    => $this->customer->id,
        'name'  => 'John Doe',
        'email' => 'john@doe.com',
        'phone' => '1234567890',
        'type'  => 'customer',
    ]);
});

it('should require a name', function () {
    Livewire::test(Customers\Update::class)
        ->set('customer', $this->customer)
        ->set('customer.name', '')
        ->set('customer.email', 'john@doe.com')
        ->set('customer.phone', '1234567890')
        ->call('save')
        ->assertHasErrors(['customer.name' => 'required']);

    assertDatabaseHas('customers', [
        'id'    => $this->customer->id,
        'name'  => $this->customer->name,
        'email' => $this->customer->email,
        'phone' => $this->customer->phone,
        'type'  => $this->customer->type,
    ]);
});

it('should require an email or phone', function () {
    Livewire::test(Customers\Update::class)
        ->set('customer', $this->customer)
        ->set('customer.name', 'John Doe')
        ->set('customer.email', '')
        ->set('customer.phone', '')
        ->call('save')
        ->assertHasErrors();
});

it('should require a valid email', function () {
    Livewire::test(Customers\Update::class)
        ->set('customer', $this->customer)
        ->set('customer.name', 'John Doe')
        ->set('customer.email', 'invalid-email')
        ->set('customer.phone', '')
        ->call('save')
        ->assertHasErrors(['customer.email' => 'email']);
});

it('should require a unique email', function () {
    Livewire::test(Customers\Create::class)
    ->set('name', 'John Doe')
    ->set('email', 'john@doe.com')
    ->set('phone', '1234567890')
    ->call('save')
    ->assertHasNoErrors();

    Livewire::test(Customers\Update::class)
    ->set('customer', $this->customer)
    ->set('customer.name', 'John Doe')
    ->set('customer.email', 'john@doe.com')
    ->set('customer.phone', '1234567870')
    ->call('save')
    ->assertHasErrors(['customer.email' => 'unique']);
});

it('should require a unique phone', function () {
    Livewire::test(Customers\Create::class)
    ->set('name', 'John Doe')
    ->set('email', 'john@doe.com')
    ->set('phone', '1234567890')
    ->call('save')
    ->assertHasNoErrors();

    Livewire::test(Customers\Update::class)
    ->set('customer', $this->customer)
    ->set('customer.name', 'Any Doe')
    ->set('customer.email', 'any@doe.com')
    ->set('customer.phone', '1234567890')
    ->call('save')
    ->assertHasErrors(['customer.phone' => 'unique']);
});

it('should be able to update a customer without a phone', function () {
    Livewire::test(Customers\Update::class)
        ->set('customer', $this->customer)
        ->set('customer.name', 'John Doe')
        ->set('customer.email', 'john@doe.com')
        ->set('customer.phone', '')
        ->call('save')
        ->assertHasNoErrors();
});

it('should be able to update a customer without an email', function () {
    Livewire::test(Customers\Update::class)
        ->set('customer', $this->customer)
        ->set('customer.name', 'John Doe')
        ->set('customer.email', '')
        ->set('customer.phone', '1234567890')
        ->call('save')
        ->assertHasNoErrors();
});

todo('should require a valid phone', function () {});
