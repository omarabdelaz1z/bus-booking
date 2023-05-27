<?php

namespace Tests\Unit;

use App\Helpers\Helper;
use PHPUnit\Framework\TestCase;

class OverlappingTest extends TestCase
{
    public function test_overlapping_start_no_overlap(): void
    {
        $this->assertFalse(
            Helper::checkOverlapping(
                requestedSource: 1,
                requestedDestination: 2,
                bookedSource: 2,
                bookedDestination: 3
            )
        );
    }

    public function test_overlapping_end_no_overlap(): void
    {
        $this->assertFalse(
            Helper::checkOverlapping(
                requestedSource: 2,
                requestedDestination: 3,
                bookedSource: 1,
                bookedDestination: 2
            )
        );
    }

    public function test_overlapping_start_overlap(): void
    {
        $this->assertTrue(
            Helper::checkOverlapping(
                requestedSource: 1,
                requestedDestination: 3,
                bookedSource: 2,
                bookedDestination: 4
            )
        );
    }

    public function test_overlapping_end_overlap(): void
    {
        $this->assertTrue(
            Helper::checkOverlapping(
                requestedSource: 2,
                requestedDestination: 4,
                bookedSource: 1,
                bookedDestination: 3
            )
        );
    }
    public function test_overlapping_part_of_overlap(): void
    { 
        // This assertion fails because the overlap algorithm
        // fails when the requested trip is part of the booked trip
        // but not the other way around
        $this->assertTrue(
            Helper::checkOverlapping(
                requestedSource: 2,
                requestedDestination: 3,
                bookedSource: 1,
                bookedDestination: 5
            )
        );
        
        $this->assertTrue(
            Helper::checkOverlapping(
                requestedSource: 1,
                requestedDestination: 5,
                bookedSource: 2,
                bookedDestination: 3
            )
        );
    }

    public function test_overlapping_complete_overlap(): void
    {
        $this->assertTrue(
            Helper::checkOverlapping(
                requestedSource: 1,
                requestedDestination: 3,
                bookedSource: 1,
                bookedDestination: 3
            )
        );
    }
}