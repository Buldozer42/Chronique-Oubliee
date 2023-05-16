<?php

namespace App\Entity;

use App\Repository\EncounterRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Mixed_;
use Webmozart\Assert\Mixin;

/**
 * @ORM\Entity(repositoryClass=EncounterRepository::class)
 */
class Encounter
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array")
     */
    private $characters = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCharacters(): ?array
    {
        return $this->characters;
    }

    public function setCharacters(array $characters): self
    {
        $this->characters = $characters;

        return $this;
    }

    public function addCharacter($character): self
    {
        $this->characters[] = $character;
        $this->orderCharactersByInit();

        return $this;
    }

    public function removeCharacter($character): self
    {
        $key = array_search($character, $this->characters);

        if ($key !== false) {
            unset($this->characters[$key]);
        }

        return $this;
    }

    public function countCharactersById($id): int
    {
        $count = 0;

        foreach ($this->characters as $character) {
            if ($character->getId() === $id) {
                $count++;
            }
        }

        return $count;
    }

    public function getCharacterByName($name)
    {
        foreach ($this->characters as $character) {
            if ($character->getName() === $name) {
                return $character;
            }
        }

        return null;
    }

    public function orderCharactersByInit() : void {
        usort($this->characters, function ($a, $b) {
            return $b->getInit() <=> $a->getInit();
        });
    }
}
