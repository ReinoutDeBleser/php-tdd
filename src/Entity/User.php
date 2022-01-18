<?php

namespace App\Entity;

class User
{
    private string $password;
    private string $email;
    private int $credit;
    private bool $member;

    public function __construct($member)
    {
        $this->member = $member;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return int
     */
    public function getCredit(): int
    {
        return $this->credit;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return bool
     */
    public function isMember(): bool
    {
        return $this->member;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @param int $credit
     */
    public function setCredit(int $credit): void
    {
        $this->credit = $credit;
    }

    /**
     * @param bool $member
     */
    public function setMember(bool $member): void
    {
        $this->member = $member;
    }

}