<?php

use App\Listeners\Auth\CreateValidationCode;
use App\Livewire\Auth\Register;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseCount;
use function PHPUnit\Framework\assertTrue;

it('should send a verification code to the new users email', function () {
    Notification::fake();

    Livewire::test(Register::class)
        ->set('name', 'John Doe')
        ->set('email', 'jhon@doe.com')
        ->set('email_confirmation', 'jhon@doe.com')
        ->set('password', 'password')
        ->call('submit')
        ->assertHasNoErrors();

    assertDatabaseCount('users', 1);
})->group('auth');

it('should create a new validation code and save in the users table', function () {
    $user     = User::factory()->create(['email_verified_at' => null, 'validation_code' => null]);
    $event    = new Registered($user);
    $listener = new CreateValidationCode();
    $listener->handle($event);

    $user->refresh();

    expect($user->validation_code)->not->toBeNull()
        ->and($user->validation_code)->toBeNumeric();
    assertTrue(strlen($user->validation_code) === 6);
});

it('making sure that the listener to send the code is linked to the registered event', function () {

})->todo();
