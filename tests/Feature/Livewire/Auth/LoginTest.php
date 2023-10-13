<?php

use App\Livewire\Auth\Login;
use Livewire\Livewire;

it('should render the component', function () {
    Livewire::test(Login::class)
            ->assertOk();
});

it('should be able to login', function () {

});
