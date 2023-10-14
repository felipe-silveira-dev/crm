<?php

use function Pest\Laravel\get;

test('need to have a route  to passord recovery', function () {
    get(route('auth.password.recovery'))->assertOk();
});
