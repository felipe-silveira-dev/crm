<?php

use App\Models\{Permission, User};
use Database\Seeders\PermissionSeeder;
use Illuminate\Support\Facades\{Cache, DB};

use function Pest\Laravel\{actingAs, assertDatabaseHas, seed};

it('should be able to give an user a permission to do something', function () {
    /** @var User $user */
    $user = User::factory()->create();

    $user->givePermissionTo('be an admin');

    expect($user->hasPermissionTo('be an admin'))->toBeTrue();

    assertDatabaseHas('permissions', [
        'key' => 'be an admin',
    ]);

    assertDatabaseHas('permission_user', [
        'user_id'       => $user->id,
        'permission_id' => Permission::where('key', '=', 'be an admin')->first()->id,
    ]);
});

test('permission has to have a seeder', function () {
    $this->seed(PermissionSeeder::class);
    assertDatabaseHas('permissions', [
        'key' => 'be an admin',
    ]);
});

test('seed with an admin user', function () {
    seed([
        PermissionSeeder::class,
        UsersSeeder::class,
    ]);

    assertDatabaseHas('permissions', [
        'key' => 'be an admin',
    ]);

    assertDatabaseHas('permission_user', [
        'user_id'       => User::first()?->id,
        'permission_id' => Permission::where('key', '=', 'be an admin')->first()?->id,
    ]);
});

it('should block the access to an admin page if the user does not have the permission', function () {
    seed(PermissionSeeder::class);

    $user = User::factory()->create();

    actingAs($user)
        ->get(route('admin.dashboard'))
        ->assertForbidden();
});

test('make sure that we are using cache to store user permissions', function () {
    $user = User::factory()->create();
    $user->givePermissionTo('be an admin');
    $cacheKey = 'user:' . $user->id . ':permissions';

    expect(Cache::has($cacheKey))->toBeTrue('Checking if cache key exists')
        ->and(Cache::get($cacheKey))->toBe($user->permissions, 'Checking if cache key has the correct value');
});

test('make sure that we are using the cache the retrieve', function () {
    $user = User::factory()->create();
    $user->givePermissionTo('be an admin');

    // Verificar que não ocorreu nenhuma consulta ao banco de dados
    DB::listen(fn ($q) => throw new Exception('Query executada'));
    $user->hasPermissionTo('be an admin');
    expect(true)->toBeTrue();
});
