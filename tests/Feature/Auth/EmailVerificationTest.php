<?php

use App\Listeners\Auth\CreateValidationCode;
use App\Models\User;
use App\Notifications\Auth\ValidationCodeNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Notification;

use function PHPUnit\Framework\assertTrue;

beforeEach(function () {
    Notification::fake();
});

it('should send a validation code to the new users email', function () {
    $user     = User::factory()->create(['email_verified_at' => null, 'validation_code' => null]);
    $event    = new Registered($user);
    $listener = new CreateValidationCode();
    $listener->handle($event);

    Notification::assertSentTo(
        $user,
        ValidationCodeNotification::class
    );
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
