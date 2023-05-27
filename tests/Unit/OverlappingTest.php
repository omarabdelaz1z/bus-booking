<?php

namespace Tests\Unit;

use App\Helpers\Helper;
use PHPUnit\Framework\TestCase;

class OverlappingTest extends TestCase
{
    public function test_overlapping_no_overlap(): void
    {
        $this->assertFalse(
            Helper::checkOverlapping(
                requestedSource: 2,
                requestedDestination: 3,
                bookedSource: 0,
                bookedDestination: 2
            )
        );
    }

    public function test_overlapping_overlap(): void
    {
        $this->assertTrue(
            Helper::checkOverlapping(
                requestedSource: 2,
                requestedDestination: 6,
                bookedSource: 4,
                bookedDestination: 10
            )
        );
    }
}
