<?php

test('dump values not used in project')
    ->expect(['dd', 'dump'])
    ->not->toBeUsed();
