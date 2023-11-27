<?php

use function Pest\Stressless\stress;

test('has a average response time less than 100 ms', function () {
    $result = stress('http://localhost')->for(10)->seconds();

    expect($result->requests()->duration()->med())->toBeLessThan(100);
});
