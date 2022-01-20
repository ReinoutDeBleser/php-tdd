<?php

namespace App\Tests;

use App\Entity\Bookings;
use PHPUnit\Framework\TestCase;

class BookingLengthTest extends TestCase
{
    private function dataProviderForBookingLength() : array
    {
        return [
            [0,3, true],
            [0,4, true],
            [0,5, false],
            [-5,0, false],
            [-4,0, true],
            [4,3, true],
            [0,-4,true]
        ];
    }
    /**
     * function has to start with Test
     * @dataProvider dataProviderForBookingLength
     */
    public function testBookingLength(int $startVar , int $endVar, bool $expectedOutput): void
    {
        $booking = new Bookings($startVar , $endVar);
        if (($booking->end - $booking->start) <= 4)
        {
            $this->assertTrue($expectedOutput && ($booking->end - $booking->start) <= 4 );
        }
        else {
            $this->assertFalse($expectedOutput && ($booking->end - $booking->start) <= 4 );
        }
    }
}