<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PlayerRepository::class)
 */
class Player
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Le nom ne peut pas être vide.")
     * @Assert\Length(max=50)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\NotBlank(message="La classe ne peut pas être vide.")
     * @Assert\Length(max=25)
     */
    private $class;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le niveau ne peut pas être vide.")
     * @Assert\Positive(message="Le niveau doit être positif.")
     */
    private $level;

    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\NotBlank(message="La race ne peut pas être vide.")
     * @Assert\Length(max=25)
     */
    private $race;

    /**
     * @ORM\Column(type="string", length=1)
     * @Assert\NotBlank(message="Le sexe ne peut pas être vide.")
     * @Assert\Length(max=1)
     * @Assert\Choice({"M", "F", "A"}, message="Le sexe doit être M, F ou A.")
     */
    private $sexe;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="L'âge ne peut pas être vide.")
     * @Assert\Positive(message="L'âge doit être positif.")
     */
    private $age;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="La taille ne peut pas être vide.")
     * @Assert\Positive(message="La taille doit être positive.")
     */
    private $height;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le poids ne peut pas être vide.")
     * @Assert\Positive(message="Le poids doit être positif.")
     */
    private $weight;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="La force ne peut pas être vide.")
     * @Assert\Positive(message="La force doit être positive.")
     * @Assert\Range(min=1, max=21, notInRangeMessage="La force doit être comprise entre 1 et 21.")
     */
    private $fo;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="La dextérité ne peut pas être vide.")
     * @Assert\Positive(message="La dextérité doit être positive.")
     * @Assert\Range(min=1, max=21, notInRangeMessage="La dextérité doit être comprise entre 1 et 21.")
     */
    private $dex;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="La constitution ne peut pas être vide.")
     * @Assert\Positive(message="La constitution doit être positive.")
     * @Assert\Range(min=1, max=21, notInRangeMessage="La constitution doit être comprise entre 1 et 21.")
     */
    private $con;

    /**
     * @ORM\Column(name="`int`", type="integer")
     * @Assert\NotBlank(message="L'intelligence ne peut pas être vide.")
     * @Assert\Positive(message="L'intelligence doit être positive.")
     * @Assert\Range(min=1, max=21, notInRangeMessage="La intelligence doit être comprise entre 1 et 21.")
     */
    private $int;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="La sagesse ne peut pas être vide.")
     * @Assert\Positive(message="La sagesse doit être positive.")
     * @Assert\Range(min=1, max=21, notInRangeMessage="La sagesse doit être comprise entre 1 et 21.")
     */
    private $sag;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le charisme ne peut pas être vide.")
     * @Assert\Positive(message="Le charisme doit être positif.")
     * @Assert\Range(min=1, max=21, notInRangeMessage="La charisme doit être comprise entre 1 et 21.")
     */
    private $cha;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $advantage_fo;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $advantage_dex;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $advantage_con;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $advantage_int;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $advantage_sag;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $advantage_cha;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $magic_int;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $magic_sag;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $magic_cha;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le score d'attaque aux contact ne peut pas être vide.")
     */
    private $att_con;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le score d'attaque magique ne peut pas être vide.")
     */
    private $att_mag;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le score d'attaque à distance ne peut pas être vide.")
     */
    private $att_dis;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le score d'initiative ne peut pas être vide.")
     * @Assert\Positive(message="Le score d'initiative doit être positif.")
     */
    private $init;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le dé de vie ne peut pas être vide.")
     * @Assert\Choice(choices={4, 6, 8, 10, 12, 20}, message="Le dé de vie doit être 4, 6, 8, 10, 12 ou 20.")
     */
    private $dice_life;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le nombre de point de vie max ne peut pas être vide.")
     * @Assert\Positive(message="Le nombre de point de vie max doit être positif.")
     */
    private $max_hp;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le nombre de point de vie actuel ne peut pas être vide.")
     */
    private $hp;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le score de défence ne peut pas être vide.")
     * @Assert\PositiveOrZero(message="Le score de défence doit être positif ou nul.")
     */
    private $def;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $racial_skil;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $languages = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $weapons = [];

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $story;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $inventory = [];

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Les point de chance ne peuvent pas être vide.")
     * @Assert\PositiveOrZero(message="Les point de chance doivent être positifs ou nuls.")
     */
    private $pc;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Les point de chance max ne peuvent pas être vide.")
     * @Assert\PositiveOrZero(message="Les point de chance max doivent être positifs ou nuls.")
     */
    private $max_pc;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Les point de récupération ne peuvent pas être vide.")
     * @Assert\PositiveOrZero(message="Les point de récupération doivent être positifs ou nuls.")
     */
    private $pr;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Les point de récupération max ne peuvent pas être vide.")
     * @Assert\PositiveOrZero(message="Les point de récupération max doivent être positifs ou nuls.")
     */
    private $max_pr;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\PositiveOrZero(message="Les point de magie doivent être positifs ou nuls.")
     */
    private $pm;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\PositiveOrZero(message="Les point de magie max doivent être positifs ou nuls.")
     */
    private $max_pm;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $money = [];

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="L'encombrement ne peut pas être vide.")
     * @Assert\PositiveOrZero(message="L'encombrement doit être positifs ou nuls.")
     */
    private $clutter;

    /**
     * @ORM\Column(type="json")
     */
    private $skills = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $detrimental_states = [];

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $em;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function setClass(string $class): self
    {
        $this->class = $class;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getRace(): ?string
    {
        return $this->race;
    }

    public function setRace(string $race): self
    {
        $this->race = $race;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getFo(): ?int
    {
        return $this->fo;
    }

    public function setFo(int $fo): self
    {
        $this->fo = $fo;

        return $this;
    }

    public function getDex(): ?int
    {
        return $this->dex;
    }

    public function setDex(int $dex): self
    {
        $this->dex = $dex;

        return $this;
    }

    public function getCon(): ?int
    {
        return $this->con;
    }

    public function setCon(int $con): self
    {
        $this->con = $con;

        return $this;
    }

    public function getInt(): ?int
    {
        return $this->int;
    }

    public function setInt(int $int): self
    {
        $this->int = $int;

        return $this;
    }

    public function getSag(): ?int
    {
        return $this->sag;
    }

    public function setSag(int $sag): self
    {
        $this->sag = $sag;

        return $this;
    }

    public function getCha(): ?int
    {
        return $this->cha;
    }

    public function setCha(int $cha): self
    {
        $this->cha = $cha;

        return $this;
    }

    public function isAdvantageFo(): ?bool
    {
        return $this->advantage_fo;
    }

    public function setAdvantageFo(bool $advantage_fo): self
    {
        $this->advantage_fo = $advantage_fo;

        return $this;
    }

    public function isAdvantageDex(): ?bool
    {
        return $this->advantage_dex;
    }

    public function setAdvantageDex(bool $advantage_dex): self
    {
        $this->advantage_dex = $advantage_dex;

        return $this;
    }
    public function isAdvantageCon(): ?bool
    {
        return $this->advantage_con;
    }

    public function setAdvantageCon(bool $advantage_con): self
    {
        $this->advantage_con = $advantage_con;

        return $this;
    }

    public function isAdvantageInt(): ?bool
    {
        return $this->advantage_int;
    }

    public function setAdvantageInt(bool $advantage_int): self
    {
        $this->advantage_int = $advantage_int;

        return $this;
    }

    public function isAdvantageSag(): ?bool
    {
        return $this->advantage_sag;
    }

    public function setAdvantageSag(bool $advantage_sag): self
    {
        $this->advantage_sag = $advantage_sag;

        return $this;
    }

    public function isAdvantageCha(): ?bool
    {
        return $this->advantage_cha;
    }

    public function setAdvantageCha(bool $advantage_cha): self
    {
        $this->advantage_cha = $advantage_cha;

        return $this;
    }

    public function isMagicInt(): ?bool
    {
        return $this->magic_int;
    }

    public function setMagicInt(bool $magic_int): self
    {
        $this->magic_int = $magic_int;

        return $this;
    }

    public function isMagicSag(): ?bool
    {
        return $this->magic_sag;
    }

    public function setMagicSag(?bool $magic_sag): self
    {
        $this->magic_sag = $magic_sag;

        return $this;
    }

    public function isMagicCha(): ?bool
    {
        return $this->magic_cha;
    }

    public function setMagicCha(?bool $magic_cha): self
    {
        $this->magic_cha = $magic_cha;

        return $this;
    }

    public function getAttCon(): ?int
    {
        return $this->att_con;
    }

    public function setAttCon(int $att_con): self
    {
        $this->att_con = $att_con;

        return $this;
    }

    public function getAttMag(): ?string
    {
        return $this->att_mag;
    }

    public function setAttMag(string $att_mag): self
    {
        $this->att_mag = $att_mag;

        return $this;
    }

    public function getAttDis(): ?int
    {
        return $this->att_dis;
    }

    public function setAttDis(int $att_dis): self
    {
        $this->att_dis = $att_dis;

        return $this;
    }

    public function getInit(): ?int
    {
        return $this->init;
    }

    public function setInit(int $init): self
    {
        $this->init = $init;

        return $this;
    }

    public function getDiceLife(): ?int
    {
        return $this->dice_life;
    }

    public function setDiceLife(int $dice_life): self
    {
        $this->dice_life = $dice_life;

        return $this;
    }

    public function getMaxHp(): ?int
    {
        return $this->max_hp;
    }

    public function setMaxHp(int $max_hp): self
    {
        $this->max_hp = $max_hp;

        return $this;
    }

    public function getHp(): ?int
    {
        return $this->hp;
    }

    public function setHp(int $hp): self
    {
        $this->hp = $hp;

        return $this;
    }

    public function getDef(): ?int
    {
        return $this->def;
    }

    public function setDef(int $def): self
    {
        $this->def = $def;

        return $this;
    }

    public function getRacialSkil(): ?string
    {
        return $this->racial_skil;
    }

    public function setRacialSkil(string $racial_skil): self
    {
        $this->racial_skil = $racial_skil;

        return $this;
    }

    public function getLanguages(): ?array
    {
        return $this->languages;
    }

    public function setLanguages(?array $languages): self
    {
        $this->languages = $languages;

        return $this;
    }

    public function getWeapons(): ?string
    {
        return $this->weapons;
    }

    public function setWeapons(?string $weapons): self
    {
        $this->weapons = $weapons;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStory(): ?string
    {
        return $this->story;
    }

    public function setStory(string $story): self
    {
        $this->story = $story;

        return $this;
    }

    public function getInventory(): ?array
    {
        return $this->inventory;
    }

    public function setInventory(?array $inventory): self
    {
        $this->inventory = $inventory;

        return $this;
    }

    public function getPc(): ?int
    {
        return $this->pc;
    }

    public function setPc(int $pc): self
    {
        $this->pc = $pc;

        return $this;
    }

    public function getMaxPc(): ?int
    {
        return $this->max_pc;
    }

    public function setMaxPc(int $max_pc): self
    {
        $this->max_pc = $max_pc;

        return $this;
    }

    public function getPr(): ?int
    {
        return $this->pr;
    }

    public function setPr(int $pr): self
    {
        $this->pr = $pr;

        return $this;
    }

    public function getMaxPr(): ?int
    {
        return $this->max_pr;
    }

    public function setMaxPr(int $max_pr): self
    {
        $this->max_pr = $max_pr;

        return $this;
    }

    public function getPm(): ?int
    {
        return $this->pm;
    }

    public function setPm(int $pm): self
    {
        $this->pm = $pm;

        return $this;
    }

    public function getMaxPm(): ?int
    {
        return $this->max_pm;
    }

    public function setMaxPm(int $max_pm): self
    {
        $this->max_pm = $max_pm;

        return $this;
    }

    public function getMoney(): ?string
    {
        return $this->money;
    }

    public function setMoney(string $money): self
    {
        $this->money = $money;

        return $this;
    }

    private function getMod(int $val): ?int
    {
        return floor(($val - 10) / 2);
    }
    public function getModFo(): ?int
    {
        return $this->getMod($this->getFo());
    }

    public function getModDex(): ?int
    {
        return $this->getMod($this->getDex());
    }

    public function getModCon(): ?int
    {
        return $this->getMod($this->getCon());
    }

    public function getModInt(): ?int
    {
        return $this->getMod($this->getInt());
    }

    public function getModSag(): ?int
    {
        return $this->getMod($this->getSag());
    }

    public function getModCha(): ?int
    {
        return $this->getMod($this->getCha());
    }

    public function getModMag(): ?int
    {
        // check if any of magic attributes is set or is true
        if ($this->isMagicInt()){
            return $this->getModInt();
        }
        if ($this->isMagicSag()){
            return $this->getModSag();
        }
        if ($this->isMagicCha()){
            return $this->getModCha();
        }
        return 0;
    }

    public function isModMag() : ?bool
    {
        return $this->isMagicInt() || $this->isMagicSag() || $this->isMagicCha();
    }

    public function addLanguage(Language $language): void
    {
        $this->languages[] = $language;
    }

    public function removeLanguage(Language $language): void
    {
        $this->languages = array_filter($this->languages, function ($l) use ($language) {
            return $l->getName() !== $language->getName();
        });
    }

    public function addInventory(InventoryItem $item): void
    {
        $this->inventory[] = $item;
    }

    public function removeInventory(InventoryItem $item): void
    {
        $this->inventory = array_filter($this->inventory, function ($i) use ($item) {
            return $i->getName() !== $item->getName();
        });
    }

    public function getClutter(): ?int
    {
        return $this->clutter;
    }

    public function setClutter(int $clutter): self
    {
        $this->clutter = $clutter;

        return $this;
    }

    public function getSkills(): ?string
    {
        return $this->skills;
    }

    public function setSkills(string $skills): self
    {
        $this->skills = $skills;

        return $this;
    }

    public function getDetrimentalStates(): ?array
    {
        return $this->detrimental_states;
    }

    public function setDetrimentalStates(?array $detrimental_states): self
    {
        $this->detrimental_states = $detrimental_states;

        return $this;
    }

    public function manageDetrimentalStates(DetrimentalState $detrimental_state) : void
    {
        if (in_array($detrimental_state, $this->detrimental_states)){
            $this->removeDetrimentalState($detrimental_state);
        } else {
            $this->addDetrimentalState($detrimental_state);
        }
    }

    private function addDetrimentalState(DetrimentalState $detrimental_state) : void
    {
        $this->detrimental_states[] = $detrimental_state;
        if ($detrimental_state->getName() === 'blind'){
            $this->setInit($this->getInit() - 5);
            $this->setAttCon($this->getAttCon() - 5);
            $this->setDef($this->getDef() - 5);
            $this->setAttDis($this->getAttDis() - 10);
        }
        elseif ($detrimental_state->getName() === 'stun' || $detrimental_state->getName() === 'surprised'){
            $this->setDef($this->getDef() - 5);
        }
        elseif ($detrimental_state->getName() === 'reversed'){
            $this->setAttCon($this->getAttCon() - 5);
            $this->setDef($this->getDef() - 5);
            $this->setAttDis($this->getAttDis() - 5);
        }
        elseif ($detrimental_state->getName() === 'rage'){
            $this->setAttCon($this->getAttCon() + 2);
            $this->setDef($this->getDef() - 4);
        }
        elseif ($detrimental_state->getName() === 'fury'){
            $this->setAttCon($this->getAttCon() + 3);
            $this->setDef($this->getDef() - 6);
        }
    }

    private function removeDetrimentalState(DetrimentalState $detrimental_state) : void
    {
        $this->detrimental_states = array_filter($this->detrimental_states, function ($d) use ($detrimental_state) {
            return $d->getName() !== $detrimental_state->getName();
        });
        if ($detrimental_state->getName() === 'blind'){
            $this->setInit($this->getInit() + 5);
            $this->setAttCon($this->getAttCon() + 5);
            $this->setDef($this->getDef() + 5);
            $this->setAttDis($this->getAttDis() + 10);
        }
        elseif ($detrimental_state->getName() === 'stun' || $detrimental_state->getName() === 'surprised'){
            $this->setDef($this->getDef() + 5);
        }
        elseif ($detrimental_state->getName() === 'reversed'){
            $this->setAttCon($this->getAttCon() + 5);
            $this->setDef($this->getDef() + 5);
            $this->setAttDis($this->getAttDis() + 5);
        }
        elseif ($detrimental_state->getName() === 'rage'){
            $this->setAttCon($this->getAttCon() - 2);
            $this->setDef($this->getDef() + 4);
        }
        elseif ($detrimental_state->getName() === 'fury'){
            $this->setAttCon($this->getAttCon() - 3);
            $this->setDef($this->getDef() + 6);
        }
    }

    public function removeCustomDetrimentalState() : void {
        $this->detrimental_states = array_filter($this->detrimental_states, function ($d) {
            return $d->getName() !== 'other';
        });
    }

    public function getEm(): ?int
    {
        return $this->em;
    }

    public function setEm(?int $em): self
    {
        $this->em = $em;

        return $this;
    }
}
