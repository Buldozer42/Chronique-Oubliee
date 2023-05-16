<?php

namespace App\Entity;
class Attack
{
    private $name;

    private $bonus;

    private $dm;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getBonus(): int
    {
        return $this->bonus;
    }

    public function setBonus(int $bonus): void
    {
        $this->bonus = $bonus;
    }

    public function getDm(): string
    {
        return $this->dm;
    }

    public function setDm(string $dm): void
    {
        $this->dm = $dm;
    }
}