<?php

use App\Livewire\Opportunities;
use App\Models\{User};
use Livewire\Livewire;

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas};

beforeEach(function () {
    $user = User::factory()->create();
    actingAs($user);
});

it('should create a opportunity', function () {
    Livewire::test(Opportunities\Create::class)
        ->set('form.title', 'John Doe')
        ->set('form.status', 'open')
        ->set('form.amount', '1250')
        ->call('save')
        ->assertHasNoErrors();

    assertDatabaseHas('opportunities', [
        'title'  => 'John Doe',
        'status' => 'open',
        'amount' => 1250,
    ]);
});

it('should require a title', function () {
    Livewire::test(Opportunities\Create::class)
        ->set('form.title', '')
        ->set('form.status', 'open')
        ->set('form.amount', '1250')
        ->call('save')
        ->assertHasErrors(['form.title' => 'required']);

    assertDatabaseCount('opportunities', 0);
});

describe('validations', function () {
    test('title', function ($rule, $value) {
        Livewire::test(Opportunities\Create::class)
            ->set('form.title', $value)
            ->call('save')
            ->assertHasErrors(['form.title' => $rule]);
    })->with([
        'required' => ['required', ''],
        'min'      => ['min', 'Jo'],
        'max'      => ['max', str_repeat('a', 256)],
    ]);

    test('status', function ($rule, $value) {
        Livewire::test(Opportunities\Create::class)
            ->set('form.title', 'John Doe')
            ->set('form.status', $value)
            ->call('save')
            ->assertHasErrors(['form.status' => $rule]);
    })->with([
        'required' => ['required', ''],
        'in'       => ['in', 'invalid'],
    ]);

    test('amount', function ($rule, $value) {
        Livewire::test(Opportunities\Create::class)
            ->set('form.title', 'John Doe')
            ->set('form.status', 'open')
            ->set('form.amount', $value)
            ->call('save')
            ->assertHasErrors(['form.amount' => $rule]);
    })->with([
        'required' => ['required', ''],
    ]);
});
