<?php

namespace App\Entity;

use App\Repository\CreatureRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=CreatureRepository::class)
 */
class Creature
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\NotBlank(message="Le nom ne peut pas être vide.")
     * @Assert\Length(max=25)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank(message="Le type ne peut pas être vide.")
     * @Assert\Length(max=20)
     * @Assert\Choice({"Humanoïde", "Vivante", "Non-vivante", "Végétative"}, 
     * message="Le type doit être Humanoïde, Vivante, Non-vivante ou Végétative.")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\NotBlank(message="La famille ne peut pas être vide.")
     * @Assert\Length(max=25)
     */
    private $family;

    /**
     * @ORM\Column(type="string", length=15)
     * @Assert\NotBlank(message="La taille ne peut pas être vide.")
     * @Assert\Length(max=15)
     * @Assert\Choice({"Minuscule", "Très petite", "Petite", "Moyenne", "Grande", "Énorme", "Colossale"}, 
     * message="La taille doit être Minuscule, Très petite, Petite, Moyenne, Grande, Énorme ou Colossale.")
     */
    private $size;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="L'environnement naturel ne peut pas être vide.")
     * @Assert\Length(max=50)
     * @Assert\Choice({"Aucun", "Aquatique", "Désertique", "Forêt", "Marécage", "Montagne", "Plaine", "Souterrain", "Toundra", "Urbain", "Spécial"}, 
     * message= "L'environnement naturel doit être Aucun, Aquatique, Désertique, Forêt, Marécage, Montagne, Plaine, Souterrain, Toundra, Urbain ou Spécial.")
     */
    private $natural_environment;

    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\NotBlank(message="L'archétype ne peut pas être vide.")
     * @Assert\Length(max=10)
     * @Assert\Choice({"Inférieur", "Rapide", "Puissant", "Standard"}, message="L'archétype doit être Inférieur, Rapide, Puissant ou Standard.")
     */
    private $archetype;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le niveau de puissance ne peut pas être vide.")
     * @Assert\PositiveOrZero(message="Le niveau de puissance doit être positif")
     * @Assert\Range(min=0, max=5, notInRangeMessage="Le niveau de puissance doit être compris entre 1 et 5.")
     */
    private $boss_rank;

    /**
     * @ORM\Column(type="string", length=15)
     * @Assert\NotBlank(message="Le type de boss ne peut pas être vide.")
     * @Assert\Length(max=15)
     * @Assert\Choice({"Aucun","Standard", "Berserk", "Rapide", "Puissant", "Résistant"}, message="Le type de boss doit être Standard, Berserk, Rapide, Puissant, Résistant ou Aucun.")
     */
    private $boss_type;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le niveau de puissance ne peut pas être vide.")
     * @Assert\PositiveOrZero(message="Le niveau de puissance doit être positif ou nul.")
     */
    private $nc;

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
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le score d'initiative ne peut pas être vide.")
     * @Assert\Positive(message="Le score d'initiative doit être positif.")
     */
    private $init;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le mod de force ne peut pas être vide.")
     * @Assert\Positive(message="Le mod de force doit être positive.")
     */
    private $fo;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="La dextérité ne peut pas être vide.")
     * @Assert\Positive(message="La dextérité doit être positive.")
     */
    private $dex;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="La constitution ne peut pas être vide.")
     * @Assert\Positive(message="La constitution doit être positive.")
     */
    private $con;

    /**
     * @ORM\Column(name="`int`", type="integer")
     * @Assert\NotBlank(message="L'intelligence ne peut pas être vide.")
     * @Assert\Positive(message="L'intelligence doit être positive.")
     */
    private $int;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="La sagesse ne peut pas être vide.")
     * @Assert\Positive(message="La sagesse doit être positive.")
     */
    private $sag;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le charisme ne peut pas être vide.")
     * @Assert\Positive(message="Le charisme doit être positif.")
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
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="La réduction de dommages ne peut pas être vide.")
     * @Assert\PositiveOrZero(message="La réduction de dommages doit être positif ou nul.")

     */
    private $rd;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $story;

    /**
     * @ORM\Column(type="array")
     */
    private $attacks = [];

    /**
     * @ORM\Column(type="json")
     */
    private $skills = [];

    /**
     * @ORM\Column(type="array")
     */
    private $special_skills = [];

    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\NotBlank(message="Le commentaire sur la réduction de dommages ne peut pas être vide.")
     * @Assert\Length(max=25, maxMessage="Le commentaire sur la réduction de dommages ne peut pas dépasser 25 caractères.")
     */
    private $rd_comment;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $detrimental_states = [];

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $Type): self
    {
        $this->type = $Type;

        return $this;
    }

    public function getFamily(): ?string
    {
        return $this->family;
    }

    public function setFamily(string $family): self
    {
        $this->family = $family;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getNaturalEnvironment(): ?string
    {
        return $this->natural_environment;
    }

    public function setNaturalEnvironment(string $natural_environment): self
    {
        $this->natural_environment = $natural_environment;

        return $this;
    }

    public function getArchetype(): ?string
    {
        return $this->archetype;
    }

    public function setArchetype(string $archetype): self
    {
        $this->archetype = $archetype;

        return $this;
    }

    public function getBossRank(): ?int
    {
        return $this->boss_rank;
    }

    public function setBossRank(int $boss_rank): self
    {
        $this->boss_rank = $boss_rank;

        return $this;
    }

    public function getBossType(): ?string
    {
        return $this->boss_type;
    }

    public function setBossType(string $boss_type): self
    {
        $this->boss_type = $boss_type;

        return $this;
    }

    public function getNc(): ?int
    {
        return $this->nc;
    }

    public function setNc(int $nc): self
    {
        $this->nc = $nc;

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

    public function getMaxHp(): ?int
    {
        return $this->max_hp;
    }

    public function setMaxHp(int $max_hp): self
    {
        $this->max_hp = $max_hp;

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

    public function getInit(): ?int
    {
        return $this->init;
    }

    public function setInit(int $init): self
    {
        $this->init = $init;

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

    public function getRd(): ?int
    {
        return $this->rd;
    }

    public function setRd(int $rd): self
    {
        $this->rd = $rd;

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

    public function setStory(?string $story): self
    {
        $this->story = $story;

        return $this;
    }

    public function getAttacks(): ?array
    {
        return $this->attacks;
    }

    public function setAttacks(array $attacks): self
    {
        $this->attacks = $attacks;

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

    public function getSpecialSkills(): ?array
    {
        return $this->special_skills;
    }

    public function setSpecialSkills(array $special_skills): self
    {
        $this->special_skills = $special_skills;

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

    public function addAttack(Attack $attack): void
    {
        $this->attacks[] = $attack;
    }

    public function removeAttack(Attack $attack): void
    {
        $this->attacks = array_filter($this->attacks, function ($l) use ($attack) {
            return $l->getName() !== $attack->getName();
        });
    }
    public function addSpecialSkill(SpecialSkill $special_skill): void
    {
        $this->special_skills[] = $special_skill;
    }

    public function removeSpecialSkill(SpecialSkill $special_skill): void
    {
        $this->special_skills = array_filter($this->special_skills, function ($l) use ($special_skill) {
            return $l->getName() !== $special_skill->getName();
        });
    }

    public function getRdComment(): ?string
    {
        return $this->rd_comment;
    }

    public function setRdComment(string $rd_comment): self
    {
        $this->rd_comment = $rd_comment;

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
            for ($i = 0; $i < count($this->attacks); $i++){
                $this->attacks[$i]->setBonus($this->attacks[$i]->getBonus() - 5);
            }
            $this->setDef($this->getDef() - 5);
        }
        elseif ($detrimental_state->getName() === 'stun' || $detrimental_state === 'surprised'){
            $this->setDef($this->getDef() - 5);
        }
        elseif ($detrimental_state->getName() === 'reversed'){
            for ($i = 0; $i < count($this->attacks); $i++){
                $this->attacks[$i]->setBonus($this->attacks[$i]->getBonus() - 5);
            }
            $this->setDef($this->getDef() - 5);
        }
    }

    private function removeDetrimentalState(DetrimentalState $detrimental_state) : void
    {
        $this->detrimental_states = array_filter($this->detrimental_states, function ($d) use ($detrimental_state) {
            return $d->getName() !== $detrimental_state->getName();
        });
        if ($detrimental_state->getName() === 'blind'){
            $this->setInit($this->getInit() + 5);
            for ($i = 0; $i < count($this->attacks); $i++){
                $this->attacks[$i]->setBonus($this->attacks[$i]->getBonus() + 5);
            }
            $this->setDef($this->getDef() + 5);
        }
        elseif ($detrimental_state->getName() === 'stun' || $detrimental_state->getName() === 'surprised'){
            $this->setDef($this->getDef() + 5);
        }
        elseif ($detrimental_state->getName() === 'reversed'){
            for ($i = 0; $i < count($this->attacks); $i++){
                $this->attacks[$i]->setBonus($this->attacks[$i]->getBonus() + 5);
            }
            $this->setDef($this->getDef() + 5);
        }
    }
}