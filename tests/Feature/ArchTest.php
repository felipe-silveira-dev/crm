<?php

test('globals')
    ->expect(['dd', 'dump', 'tap', 'tinker', 'ds'])
    ->not->toBeUsed();
