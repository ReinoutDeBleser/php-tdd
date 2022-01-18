<?php

namespace App\Entity;

use App\Entity\User;

class Room {

    private string $name;
    private bool $exclusive;

    public function __construct(bool $exclusive)
    {
        $this->exclusive =$exclusive;
    }

    function canBook(User $user)
    {
        return ($this->isExclusive() && $user->isMember()) || !$this->isExclusive();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isExclusive(): bool
    {
        return $this->exclusive;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param bool $exclusive
     */
    public function setExclusive(bool $exclusive): void
    {
        $this->exclusive = $exclusive;
    }
}