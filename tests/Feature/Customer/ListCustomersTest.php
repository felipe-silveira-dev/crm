<?php

use App\Enums\Can;
use App\Livewire\Customers;
use App\Models\{Customer, Permission, User};
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

it('should be able to access route customers', function () {
    $user = User::factory()->admin()->create();

    actingAs($user)
        ->get(route('customers'))
        ->assertOk();
});


it('should list all customers in the page', function () {
    $user  = User::factory()->create();
    $customers = Customer::factory()->count(10)->create();

    actingAs($user);

    $lw = Livewire::test(Customers\Index::class);
    $lw->assertSet('customers', function ($customers) {
        expect($customers)
            ->toBeInstanceOf(LengthAwarePaginator::class)
            ->toHaveCount(10);

        return true;
    });

    foreach ($customers as $customer) {
        $lw->assertSee($customer->name);
    }
});

test('table format', function () {

    actingAs(User::factory()->admin()->create());

    Livewire::test(Index::class)
        ->assertSet('headers', [
            ['key' => 'id', 'label' => '#', 'sortColumnBy' => 'id', 'sortDirection' => 'asc'],
            ['key' => 'name', 'label' => 'Name', 'sortColumnBy' => 'id', 'sortDirection' => 'asc'],
            ['key' => 'email', 'label' => 'Email', 'sortColumnBy' => 'id', 'sortDirection' => 'asc'],
        ]);
});

it('should be able to filter by name and email', function () {
    $admin = User::factory()->admin()->create(['name' => 'Joe Doe', 'email' => 'admin@crm.com']);
    $mario = User::factory()->create(['name' => 'Mario Silva', 'email' => 'little_guy@gmail.com']);

    actingAs($admin);

    $lw = Livewire::test(Index::class);
    $lw->assertSet('customers', function ($customers) {
        expect($customers)
            ->toBeInstanceOf(LengthAwarePaginator::class)
            ->toHaveCount(2);

        return true;
    })
    ->set('search', 'Mario')
    ->assertSet('customers', function ($customers) {
        expect($customers)
            ->toHaveCount(1)
            ->first()->name->toBe('Mario Silva');

        return true;
    });
});

it('should be able to filter permission.key', function () {
    $admin      = User::factory()->admin()->create(['name' => 'Joe Doe', 'email' => 'admin@crm.com']);
    $mario      = User::factory()->create(['name' => 'Mario Silva', 'email' => 'little_guy@gmail.com']);
    $permission = Permission::where('key', '=', Can::BE_AN_ADMIN->value)->first();

    actingAs($admin);

    $lw = Livewire::test(Index::class);
    $lw->assertSet('customers', function ($customers) {
        expect($customers)
            ->toBeInstanceOf(LengthAwarePaginator::class)
            ->toHaveCount(2);

        return true;
    })
    ->set('search_permissions', [$permission->id])
    ->assertSet('customers', function ($customers) {
        expect($customers)
            ->toHaveCount(1)
            ->first()->name->toBe('Joe Doe');

        return true;
    });
});

it('shoul be able to list deleted customers', function () {
    $admin        = User::factory()->admin()->create(['name' => 'Joe Doe', 'email' => 'admin@gmail.com']);
    $deletedcustomers = User::factory()->count(2)->create(['deleted_at' => now()]);

    actingAs($admin);
    Livewire::test(Customers\Index::class)
        ->assertSet('customers', function ($customers) {
            expect($customers)->toHaveCount(1);

            return true;
        })
        ->set('search_trash', true)
        ->assertSet('customers', function ($customers) {
            expect($customers)
                ->toHaveCount(2);

            return true;
        });
});

it('should be able to sort by name', function () {
    $admin = User::factory()->admin()->create(['name' => 'Joe Doe', 'email' => 'admin@gmail.com']);
    $customers = User::factory()->create(['name' => 'Mario', 'email' => 'little_guy@gmail.com']);

    actingAs($admin);
    Livewire::test(Customers\Index::class)
        ->set('sortDirection', 'asc')
        ->set('sortColumnBy', 'name')
        ->assertSet('customers', function ($customers) {
            expect($customers)
                ->first()->name->toBe('Joe Doe')
                ->and($customers)->last()->name->toBe('Mario');

            return true;
        })
        ->set('sortDirection', 'desc')
        ->set('sortColumnBy', 'name')
        ->assertSet('customers', function ($customers) {
            expect($customers)
                ->first()->name->toBe('Mario')
                ->and($customers)->last()->name->toBe('Joe Doe');

            return true;
        });
});

it('should be able to paginate the result', function () {
    $admin = User::factory()->admin()->create(['name' => 'Joe Doe', 'email' => 'admin@gmail.com']);
    User::factory()->count(30)->create();

    actingAs($admin);
    Livewire::test(Customers\Index::class)
        ->assertSet('customers', function (LengthAwarePaginator $customers) {
            expect($customers)
                ->toHaveCount(10);

            return true;
        })
        ->set('perPage', 20)
        ->assertSet('customers', function (LengthAwarePaginator $customers) {
            expect($customers)
                ->toHaveCount(20);

            return true;
        });
    ;
});
