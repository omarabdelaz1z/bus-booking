<?php

namespace App\Helpers;

class Helper
{
    /**
     * Check if the requested trip overlaps with a booking
     *
     * @param int requestedSource
     * @param int requestedDestination
     * @param int bookedSource
     * @param int bookedDestination
     * @return bool
     */
    public static function checkOverlapping(int $requestedSource, int $requestedDestination, int $bookedSource, int $bookedDestination)
    {
        if ($bookedSource > $requestedSource && $bookedSource < $requestedDestination) {
            return true;
        } elseif ($bookedDestination > $requestedSource && $bookedDestination < $requestedDestination) {
            return true;
        } elseif ($bookedSource == $requestedSource && $bookedDestination == $requestedDestination) {
            return true;
        }

        return false;
    }
}
