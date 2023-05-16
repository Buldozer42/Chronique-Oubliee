<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Player;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $player = new Player();
        $player->setName("Wunjir Briseurdos");
        $player->setClass("Barbare");
        $player->setLevel(9);
        $player->setRace("Nain");
        $player->setSexe("H");
        $player->setAge(75);
        $player->setHeight(125);
        $player->setWeight(75);
        $player->setFo(15);
        $player->setDex(12);
        $player->setCon(17);
        $player->setInt(7);
        $player->setSag(11);
        $player->setCha(15);
        // $player->setAttCon($player->getModFo() + $player->getLevel());
        $player->setAttCon(11);
        // $player->setAttDis($player->getModDex() + $player->getLevel());
        $player->setAttDis(10);
        // $player->setAttMag($player->getModMag() + $player->getLevel());
        $player->setAttMag(9);
        $player->setInit(14);
        $player->setDiceLife(12);
        $player->setMaxHp(103);
        $player->setHp(103);
        $player->setDef(16);
        $player->setRacialSkil("Vision dans le noir...");
        $player->setLanguages(["Nain"]);
        // weapons
        $player->setWeapons(["Hache de guerre", "Hache de jet"]);
        // description
        $player->setDescription("Description du personnage");
        // story
        $player->setStory("Histoire du personnage");
        // inventory
        $player->setInventory(["Potion de soin", "Potion de soin", "Potion de soin"]);
        $player->setMaxPc(5);
        $player->setPc(5);
        $player->setMaxPr(5);
        $player->setPr(5);
        //money
        $player->setMoney(["100"]);

        $manager->flush();
    }
}
