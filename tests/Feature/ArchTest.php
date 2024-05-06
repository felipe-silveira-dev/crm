<?php

test('globals')
    ->expect(['dd', 'dump', 'tap', 'tinker', 'ds', 'ddd', 'sleep'])
    ->not->toBeUsed();
