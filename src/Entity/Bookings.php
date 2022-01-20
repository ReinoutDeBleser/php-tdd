<?php

namespace App\Entity;

class Bookings
{
    public int $start;
    public int $end;

    public function __construct(int $start, int $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    function bookLength() {
        $bookLength = $this->end - $this->start;
        return $bookLength;
    }

}