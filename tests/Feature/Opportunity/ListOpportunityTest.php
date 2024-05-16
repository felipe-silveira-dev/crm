<?php

use App\Livewire\Opportunities;
use App\Models\{User, opportunity};
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

it('should be able to access route opportunities', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->get(route('opportunities'))
        ->assertOk();
});

it('should list all opportunities in the page', function () {
    $user          = User::factory()->create();
    $opportunities = Opportunity::factory()->count(10)->create();

    actingAs($user);

    $lw = Livewire::test(Opportunities\Index::class);
    $lw->assertSet('items', function ($items) {
        expect($items)
            ->toBeInstanceOf(LengthAwarePaginator::class)
            ->toHaveCount(10);

        return true;
    });

    foreach ($opportunities as $opportunity) {
        $lw->assertSee($opportunity->title);
    }
});

it('should be able to filter by title', function () {
    $user  = User::factory()->create(['name' => 'John Doe']);
    $mario = Opportunity::factory()->create(['title' => 'Mario Silva']);
    $joe   = Opportunity::factory()->create(['title' => 'Uva de Laranja']);

    actingAs($user);

    $lw = Livewire::test(Opportunities\Index::class);
    $lw->assertSet('items', function ($items) {
        expect($items)
            ->toBeInstanceOf(LengthAwarePaginator::class)
            ->toHaveCount(2);

        return true;
    })
    ->set('search', 'Mario')
    ->assertSet('items', function ($items) {
        expect($items)
            ->toHaveCount(1)
            ->first()->title->toBe('Mario Silva');

        return true;
    });
});

todo('shoul be able to list deleted opportunities', function () {
    $admin                = User::factory()->admin()->create(['title' => 'Joe Doe']);
    $deletedopportunities = User::factory()->count(2)->create(['deleted_at' => now()]);

    actingAs($admin);
    Livewire::test(Opportunities\Index::class)
        ->assertSet('opportunities', function ($opportunities) {
            expect($opportunities)->toHaveCount(1);

            return true;
        })
        ->set('search_trash', true)
        ->assertSet('opportunities', function ($opportunities) {
            expect($opportunities)
                ->toHaveCount(2);

            return true;
        });
});

it('should be able to sort by title', function () {
    $user  = User::factory()->create(['name' => 'Joe Doe']);
    $mario = Opportunity::factory()->create(['title' => 'Mario']);
    $joe   = Opportunity::factory()->create(['title' => 'Joe Doe']);

    actingAs($user);
    Livewire::test(Opportunities\Index::class)
        ->set('sortDirection', 'asc')
        ->set('sortColumnBy', 'title')
        ->assertSet('items', function ($items) {
            expect($items)
                ->first()->title->toBe('Joe Doe')
                ->and($items)->last()->title->toBe('Mario');

            return true;
        })
        ->set('sortDirection', 'desc')
        ->set('sortColumnBy', 'title')
        ->assertSet('items', function ($items) {
            expect($items)
                ->first()->title->toBe('Mario')
                ->and($items)->last()->title->toBe('Joe Doe');

            return true;
        });
});

it('should be able to paginate the result', function () {
    $user = User::factory()->create(['name' => 'Joe Doe']);
    Opportunity::factory()->count(30)->create();

    actingAs($user);
    Livewire::test(Opportunities\Index::class)
        ->assertSet('items', function (LengthAwarePaginator $items) {
            expect($items)
                ->toHaveCount(10);

            return true;
        })
        ->set('perPage', 20)
        ->assertSet('items', function (LengthAwarePaginator $items) {
            expect($items)
                ->toHaveCount(20);

            return true;
        });
});
