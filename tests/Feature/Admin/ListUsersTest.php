<?php

use App\Livewire\Admin\Users\Index;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

it('should be able to access route admin/users', function () {
    $user = User::factory()->admin()->create();

    actingAs($user)
        ->get(route('admin.users'))
        ->assertOk();
});

it('make sure  the route is protected by the permission BE_AN_ADMIN', function () {
    actingAs(User::factory()->create())
        ->get(route('admin.users'))
        ->assertForbidden();
});

it('should list all users in the page', function () {
    $users = User::factory()->count(10)->create();
    $user  = User::factory()->admin()->create();

    actingAs($user);

    $lw = Livewire::test(Index::class);
    $lw->assertSet('users', function ($users) {
        expect($users)
            ->toBeInstanceOf(LengthAwarePaginator::class)
            ->toHaveCount(10);

        return true;
    });

    foreach ($users as $user) {
        $lw->assertSee($user->name);
    }
});

test('table format', function () {

    actingAs(User::factory()->admin()->create());

    Livewire::test(Index::class)
        ->assertSet('headers', [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'name', 'label' => 'Name'],
            ['key' => 'email', 'label' => 'Email'],
            ['key' => 'permissions', 'label' => 'Permissions'],
            ['key' => 'actions', 'label' => 'Actions'],
        ]);
});

it('should be able to filter by name and email', function () {
    $admin = User::factory()->admin()->create(['name' => 'Joe Doe', 'email' => 'admin@crm.com']);
    $mario = User::factory()->create(['name' => 'Mario Silva', 'email' => 'little_guy@gmail.com']);

    actingAs($admin);

    $lw = Livewire::test(Index::class);
    $lw->assertSet('users', function ($users) {
        expect($users)
            ->toBeInstanceOf(LengthAwarePaginator::class)
            ->toHaveCount(2);

        return true;
    })
    ->set('search', 'Mario')
    ->assertSet('users', function ($users) {
        expect($users)
            ->toHaveCount(1)
            ->first()->name->toBe('Mario Silva');

        return true;
    });
});
