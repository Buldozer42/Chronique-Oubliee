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

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $currentRound;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $currentInit;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $initList = [];

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
        $this->updateInitList();
        return $this;
    }

    public function removeCharacter($character): self
    {
        $key = array_search($character, $this->characters);

        if ($key !== false) {
            unset($this->characters[$key]);
        }
        $this->updateInitList();
        return $this;
    }

    public function clearCharacters(): self
    {
        $this->characters = [];
        $this->initList = [];
        return $this;
    }

    public function getPlayers(): array
    {
        $players = [];
        foreach ($this->characters as $character) {
            if ($character instanceof Player) {
                $players[] = $character;
            }
        }
        return $players;
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

    public function getCurrentRound(): ?int
    {
        return $this->currentRound;
    }

    public function setCurrentRound(?int $currentRound): self
    {
        $this->currentRound = $currentRound;

        return $this;
    }

    public function getCurrentInit(): ?int
    {
        if ($this->currentInit === 0 && count($this->initList) > 0) {
            $this->currentInit = $this->initList[0];
        }
        return $this->currentInit;
    }

    public function setCurrentInit(?int $currentInit): self
    {
        $this->currentInit = $currentInit;

        return $this;
    }

    public function nextRound(): void
    {
        $this->currentRound++;
    }

    public function nextInit(): void
    {
        $key = array_search($this->currentInit, $this->initList);
        // check if currentInit is the last of the list
        if ($key === count($this->initList) - 1) {
            $this->currentInit = $this->initList[0];
            $this->nextRound();
            return;
        }
        $this->currentInit = $this->initList[$key + 1];
    }

    public function getInitList(): ?array
    {
        return $this->initList;
    }

    public function setInitList(?array $initList): self
    {
        $this->initList = $initList;

        return $this;
    }

    public function updateInitList(): void
    {
        $this->initList = [];
        foreach ($this->characters as $character) {
            // check if character init is not already in initList
            if (!in_array($character->getInit(), $this->initList)) {
                $this->initList[] = $character->getInit();
            }
        }
        rsort($this->initList);
    }

    public function resetRoundAndInit(): void
    {
        $this->currentRound = 0;
        $this->currentInit = 0;
        $this->updateInitList();
    }
}
