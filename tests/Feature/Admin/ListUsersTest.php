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
