<?php

use App\Livewire\Opportunities;
use App\Models\{Opportunity, User};
use Livewire\Livewire;

use function Pest\Laravel\{actingAs, assertDatabaseHas};

beforeEach(function () {
    actingAs(User::factory()->create());

    $this->opportunity = Opportunity::factory()->create();
});

it('should be able to update a opportunity', function () {

    Livewire::test(Opportunities\Update::class)
        ->call('load', $this->opportunity->id)
        ->set('form.customer_id', $this->opportunity->customer_id)
        ->assertPropertyWired('form.customer_id')
        ->set('form.title', 'John Doe')
        ->set('form.status', 'won')
        ->set('form.amount', '120.00')
        ->call('save')
        ->assertHasNoErrors();

    assertDatabaseHas('opportunities', [
        'id'          => $this->opportunity->id,
        'customer_id' => $this->opportunity->customer_id,
        'title'       => 'John Doe',
        'status'      => 'won',
        'amount'      => '12000',
    ]);
});

describe('validations', function () {
    test('customer_id', function ($rule, $value) {
        Livewire::test(Opportunities\Update::class)
            ->call('load', $this->opportunity->id)
            ->set('form.customer_id', $value)
            ->call('save')
            ->assertHasErrors(['form.customer_id' => $rule]);
    })->with([
        'required' => ['required', ''],
        'exists'   => ['exists', 999],
    ]);

    test('title', function ($rule, $value) {
        Livewire::test(Opportunities\Update::class)
            ->call('load', $this->opportunity->id)
            ->set('form.title', $value)
            ->call('save')
            ->assertHasErrors(['form.title' => $rule]);
    })->with([
        'required' => ['required', ''],
        'min'      => ['min', 'Jo'],
        'max'      => ['max', str_repeat('a', 256)],
    ]);

    test('status', function ($rule, $value) {
        Livewire::test(Opportunities\Update::class)
            ->call('load', $this->opportunity->id)
            ->set('form.status', $value)
            ->call('save')
            ->assertHasErrors(['form.status' => $rule]);
    })->with([
        'required' => ['required', ''],
        'in'       => ['in', 'invalid'],
    ]);

    test('amount', function ($rule, $value) {
        Livewire::test(Opportunities\Update::class)
            ->call('load', $this->opportunity->id)
            ->set('form.amount', $value)
            ->call('save')
            ->assertHasErrors(['form.amount' => $rule]);
    })->with([
        'required' => ['required', ''],
    ]);
});
