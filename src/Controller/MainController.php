<?php

namespace App\Controller;

use App\Entity\Player;
use App\Entity\Encounter;
use App\Repository\EncounterRepository;
use App\Repository\PlayerRepository;
use App\Entity\Creature;
use App\Entity\DetrimentalState;
use App\Repository\CreatureRepository;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Type\PlayerFormType;
use App\Form\Type\CreatureFormType;
use App\Form\EntitySearchType;
use App\Form\Type\NumberType;
use App\Form\ManageHpType;
use App\Form\LevelUpForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

class MainController extends AbstractController
{
    // Main page
    //-----------------------------------------------------------------------------------//
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }
    //-----------------------------------------------------------------------------------//

    // Player
    //-----------------------------------------------------------------------------------//
    /**
     * @Route("/player", name="playerlist")
     */
    public function playerlist(Request $request, PlayerRepository $playerRepository,  ?array $players): Response
    {
        $form = $this->createForm(EntitySearchType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->get('search')->getData() ?? '';
            $players = $playerRepository->findByName($search);
        }
        else {
            if ($players === null) {
                $players = $playerRepository->findAll();
            }
        }
        return $this->render('entity-list.html.twig', [
            'entitys' => $players,
            'path' => 'player',
            'title' => 'Personnages',
            'form' => $form->createView()
        ]);
    }

     /**
     * @Route("/player/{by}/{asc}", name="playerlistoredered")
     */
    public function playerlistOrdered(Request $request, PlayerRepository $playerRepository): Response
    {
        $players = $playerRepository->findAllOrderBy($request->get('by'), $request->get('asc'));
        return $this->playerlist($request, $playerRepository, $players);
    }

    /**
     * @Route("/playersheet/{id}", name="playersheet")
     */
    public function playerSheet(Player $player): Response
    {
        return $this->render('player/player-sheet.html.twig', [
            'player' => $player,
            'weapons' => json_decode($player->getWeapons(), true),
            'nbInventoryLine' => ceil(count($player->getInventory())/5),
            'money' => json_decode($player->getMoney(), true),
            'skills' => json_decode($player->getSkills(), true),
        ]);
    }

    public function playerFormBase(FormInterface $form,Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger)
    {
        $form->handleRequest($request);
        // $form->addError(new FormError('This is a global error'));
        if ($form->isSubmitted() && $form->isValid()) {
            $error = false;
            $player = $form->getData();
            $player->setAttCon($player->getModFo() + $player->getLevel());
            $player->setAttDis($player->getModDex() + $player->getLevel());
            $player->setAttMag($player->getModMag() + $player->getLevel());
            $player->setInit($player->getDex() + $form->get('bonus_init')->getData());
            $player->setDef(10 + $player->getDef() + $player->getModDex());

            $weapons = [];
            for ($i = 1; $i <= 3; $i++) {
                $weapons["weapon$i"] = [
                    "name" => $form->get("weapon{$i}_name")->getData(),
                    "att" => $form->get("weapon{$i}_att")->getData(),
                    "dm" => $form->get("weapon{$i}_dm")->getData(),
                    "special" => $form->get("weapon{$i}_special")->getData()
                ];
            }

            $player->setWeapons(json_encode($weapons));

            $money = ["po" => $form->get('po')->getData(),"pa" => $form->get('pa')->getData()];
            $player->setMoney(json_encode($money));

            $skills = [];
            foreach (range(1, 6) as $i) {
                $comp = [];
                for ($j = 1; $j <= 5; $j++) {
                    $comp["comp$j"] = [
                        "name" => $form->get("path{$i}_comp{$j}_name")->getData(),
                        "desc" => $form->get("path{$i}_comp{$j}_desc")->getData(),
                    ];
                }
                $skills["path$i"] = [
                    "name" => $form->get("path{$i}_name")->getData(),
                    "comp" => $comp,
                ];
            }
            $player->setSkills(json_encode($skills));

            if (! $player->isModMag()){
                if ($player->getMaxPm() > 0)
                {
                    $this->addFlash('error', 'Le personnage ne peut pas avoir de points de mana s\'il n\'as pas de Mod. de Magie !');
                    $error = true;
                }
            }

            if ($player->getHp() > $player->getMaxHp())
            {
                $this->addFlash('error', 'Les points de vie actuels ne peuvent pas être supérieurs aux points de vie maximum !');
                $error = true;
            }
            if ($player->getPc() > $player->getMaxPc())
            {
                $this->addFlash('error', 'Les points de chance actuels ne peuvent pas être supérieurs aux points de chance maximum !');
                $error = true;
            }
            if ($player->getPr() > $player->getMaxPr())
            {
                $this->addFlash('error', 'Les points de récupération actuels ne peuvent pas être supérieurs aux points de récupération maximum !');
                $error = true;
            }
            if ($player->getPm() > $player->getMaxPm())
            {
                $this->addFlash('error', 'Les points de mana actuels ne peuvent pas être supérieurs aux points de mana maximum !');
                $error = true;
            }

            if ($error)
            {
                return $this->render('player/player-form.html.twig', [
                    'form' => $form->createView()
                ]);
            }

            $entityManager->persist($player);
            $entityManager->flush();
            $this->addFlash('success', 'Personnage ajouté ou mis à jour !');
            return $this->redirectToRoute('playerlist');
        }
        else if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('error', 'Personnage non ajouté ! Le formulaire contient des erreurs !');
        }
        else {
            $this->addFlash('info', 'Veuillez remplir le formulaire !');
        }

        return $this->render('player/player-form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/playerform", name="playerform")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function addPlayer(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger)
    {
        $form = $this->createForm(PlayerFormType::class, new Player());
        return $this->playerFormBase($form, $request, $entityManager, $slugger);
    }
    
     /**
     * @Route("/playeredit/{id}", name="playeredit")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function editPlayer(Player $player, Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger)
    {

        $form = $this->createForm(PlayerFormType::class, $player);
        $form->get('bonus_init')->setData($player->getInit() - $player->getDex());
        $form->get('def')->setData($player->getDef() - 10 - $player->getModDex());

        $money = json_decode($player->getMoney(), true);
        $form->get('po')->setData($money['po']);
        $form->get('pa')->setData($money['pa']);

        $weapons = json_decode($player->getWeapons(), true);
        for ($i=1; $i <4;){
            $form->get('weapon'.$i.'_name')->setData($weapons['weapon'.$i]['name']);
            $form->get('weapon'.$i.'_att')->setData($weapons['weapon'.$i]['att']);
            $form->get('weapon'.$i.'_dm')->setData($weapons['weapon'.$i]['dm']);
            $form->get('weapon'.$i.'_special')->setData($weapons['weapon'.$i]['special']);
            $i++;
        }

        $skills = json_decode($player->getSkills(), true);
        for ($i = 1; $i <= 6; $i++) {
            $form->get("path{$i}_name")->setData($skills["path$i"]["name"]);
            for ($j = 1; $j <= 5; $j++)
            {
                $form->get("path{$i}_comp{$j}_name")->setData($skills["path$i"]["comp"]["comp$j"]["name"]);
                $form->get("path{$i}_comp{$j}_desc")->setData($skills["path$i"]["comp"]["comp$j"]["desc"]);
            }
        }

        return $this->playerFormBase($form, $request, $entityManager, $slugger);
    }
    
    /**
     * @Route("/playerremove/{id}", name="playerremove")
     */
    public function removePlayer(Player $player, EntityManagerInterface $entityManager) : RedirectResponse
    {
        $entityManager->remove($player);
        $entityManager->flush();
        $this->addFlash('success', 'Player was removed !');
        return $this->redirectToRoute('playerlist');
    }

    /**
     * @Route("/player_lvl_up/{id}", name="player_lvl_up")
     */
    public function levelUpPlayer(Player $player, Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugge)
    {
        $form = $this->createForm(LevelUpForm::class);
        $form->get('new_pv')->setData($player->getMaxHp());
        $skills = json_decode($player->getSkills(), true);
        for ($i = 1; $i <= 6; $i++) {
            $form->get("path{$i}_name")->setData($skills["path$i"]["name"]);
            for ($j = 1; $j <= 5; $j++)
            {
                $form->get("path{$i}_comp{$j}_name")->setData($skills["path$i"]["comp"]["comp$j"]["name"]);
                $form->get("path{$i}_comp{$j}_desc")->setData($skills["path$i"]["comp"]["comp$j"]["desc"]);
            }
        }
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $player->setLevel($player->getLevel() + 1);
            $player->setMaxHp($form->get('new_pv')->getData());
            $skills = [];
            foreach (range(1, 6) as $i) {
                $comp = [];
                for ($j = 1; $j <= 5; $j++) {
                    $comp["comp$j"] = [
                        "name" => $form->get("path{$i}_comp{$j}_name")->getData(),
                        "desc" => $form->get("path{$i}_comp{$j}_desc")->getData(),
                    ];
                }
                $skills["path$i"] = [
                    "name" => $form->get("path{$i}_name")->getData(),
                    "comp" => $comp,
                ];
            }
            $player->setSkills(json_encode($skills));

            $entityManager->persist($player);
            $entityManager->flush();
            $this->addFlash('success', 'Niveau du personnage augmenté !');
            return $this->redirectToRoute('playerlist');
        }
        else if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('error', 'Niveau du personnage non augmenté ! Le formulaire contient des erreurs !');
        }

        return $this->render('player/player-lvl-up.html.twig', [
            'player' => $player,
            'form' => $form->createView()
        ]);
    }
    //-----------------------------------------------------------------------------------//

    // Creature
    //-----------------------------------------------------------------------------------//
    /**
     * @Route("/creature", name="creaturelist")
     */
    public function creaturelist(Request $request, CreatureRepository $creatureRepository, ?array $creatures, ?string $familyName): Response
    {
        $form = $this->createForm(EntitySearchType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->get('search')->getData() ?? '';
            $creatures = $creatureRepository->findByName($search);
            $familyName = "";
        }
        else {
            if ($creatures === null) {
                $creatures = $creatureRepository->findAll();
                $familyName = "";
            }
        }
        $families = $creatureRepository->findAllFamily();
        return $this->render('entity-list.html.twig', [
            'entitys' => $creatures,
            'path' => 'creature',
            'title' => 'Créatures',
            'form' => $form->createView(),
            "familyName" => $familyName ?? "",
            'families' => $families
        ]);
    }

    /**
     * @Route("/creature/{family}", name="creature_list_by_family")
     */
    public function creatureListByFamily(Request $request, CreatureRepository $creatureRepository): Response{
        $family = $request->get('family');
        $creatures = $creatureRepository->findByFamily($family);
        return $this->creaturelist($request, $creatureRepository, $creatures, $family);
    }

    /**
     * @Route("/creature/{by}/{asc}/{family}", name="creaturelistoredered")
     */
    public function creaturelistOrdered(Request $request,CreatureRepository $creatureRepository): Response
    {
        if ($request->get('family') !== 'null'){
            $creatures = $creatureRepository->findByFamilyOrderBy($request->get('family'), $request->get('by'), $request->get('asc'));
            return $this->creaturelist($request, $creatureRepository, $creatures, $request->get('family'));
        }
        $creatures = $creatureRepository->findAllOrderBy($request->get('by'), $request->get('asc'));
        return $this->creaturelist($request, $creatureRepository, $creatures, null);
    }
    /**
     * @Route("/creaturesheet/{id}", name="creaturesheet")
     */
    public function creatureSheet(Creature $creature): Response
    {
        return $this->render('creature/creature-sheet.html.twig', [
            'creature' => $creature,
            'skills' => json_decode($creature->getSkills(), true),
        ]);
    }

    public function creatureFormBase(FormInterface $form,Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger, string $link)
    {
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $creature = $form->getData();
            $creature->setHp($creature->getMaxHp());
            $skills = [];
            foreach (range(1, 6) as $i) {
                $comp = [];
                for ($j = 1; $j <= 5; $j++) {
                    $comp["comp$j"] = [
                        "name" => $form->get("path{$i}_comp{$j}_name")->getData(),
                        "desc" => $form->get("path{$i}_comp{$j}_desc")->getData(),
                    ];
                }
                $skills["path$i"] = [
                    "name" => $form->get("path{$i}_name")->getData(),
                    "comp" => $comp,
                ];
            }
            $creature->setSkills(json_encode($skills));

            $entityManager->persist($creature);
            $entityManager->flush();
            $this->addFlash('success', 'Créature ajouté ou mis à jour !');
            return $this->redirectToRoute('creaturelist');
        }
        else if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('error', 'Créature non ajouté !');
            $this->addFlash('error', $form->getErrors());
        }
        else {
            $this->addFlash('info', 'Veuillez remplir le formulaire !');
        }

        return $this->render($link, [
            'form' => $form->createView()
        ]);
    }

    
    /**
     * @Route("/creatureform", name="creatureform")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function addCreature(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger)
    {
        $form = $this->createForm(CreatureFormType::class, new Creature());
        return $this->creatureFormBase($form, $request, $entityManager, $slugger, 'creature/creature-form.html.twig');
    }
    
     /**
     * @Route("/creatureedit/{id}", name="creatureedit")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function editCreature(Creature $creature, Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger)
    {

        $form = $this->createForm(CreatureFormType::class, $creature);

        $skills = json_decode($creature->getSkills(), true);
        for ($i = 1; $i <= 6; $i++) {
            $form->get("path{$i}_name")->setData($skills["path$i"]["name"]);
            for ($j = 1; $j <= 5; $j++)
            {
                $form->get("path{$i}_comp{$j}_name")->setData($skills["path$i"]["comp"]["comp$j"]["name"]);
                $form->get("path{$i}_comp{$j}_desc")->setData($skills["path$i"]["comp"]["comp$j"]["desc"]);
            }
        }

        return $this->creatureFormBase($form, $request, $entityManager, $slugger, 'creature/creature-form.html.twig');
    }

    /**
     * @Route("/creatureremove/{id}", name="creatureremove")
     */
    public function removeCreature(Creature $creature, EntityManagerInterface $entityManager) : RedirectResponse
    {
        $entityManager->remove($creature);
        $entityManager->flush();
        $this->addFlash('success', 'Creature was removed !');
        return $this->redirectToRoute('creaturelist');
    }

    /**
     * @Route("/creature-assisted-creation", name="creature_assisted_creation")
     */
    public function creatureAssistedCreation(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger) : Response
    {
        $form = $this->createForm(CreatureFormType::class, new Creature());
        return $this->creatureFormBase($form, $request, $entityManager, $slugger, 'creature/creature-assisted-creation.html.twig');
    }
    //-----------------------------------------------------------------------------------//

    // Encounter
    //-----------------------------------------------------------------------------------//
    /**
     * @Route("/encountersgenerator", name="encountersgenerator")
     */
    public function encountersGenerator(Request $request, EntityManagerInterface $entityManager,
        EncounterRepository $encounterRepository, PlayerRepository $playerRepository, CreatureRepository $creatureRepository): Response
    {
        $form = $this->createForm(EntitySearchType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $encounter = $encounterRepository->getFirst();
            $entityId = $form->get('entity_id')->getData();
            $entityType = $form->get('entity_type')->getData();
            if ($entityType === 'Player')
            {
                $player = $playerRepository->find($entityId);
                if ($player !== null){
                    $entity = clone $player;
                }
            }
            else{
                $creature = $creatureRepository->find($entityId);
                if ($creature !== null){
                    $entity = clone $creature;
                }
            }
            
            if (in_array($entity, $encounter->getCharacters())){
                $entity->setName($entity->getName().' ('.$encounter->countCharactersById($entityId).')');
            }
            $encounter->addCharacter($entity);
            $entityManager->persist($encounter);
            $entityManager->flush();
            return $this->redirectToRoute('encountersgenerator');
        }

        $hpForm = $this->createForm(ManageHpType::class);
        $hpForm->handleRequest($request);
        if ($hpForm->isSubmitted() && $hpForm->isValid()) {
            $encounter = $encounterRepository->getFirst();
            $tempEntity = $encounter->getCharacters()[$hpForm->get('entity_num')->getData()];
            $entity = clone $tempEntity;
            $new_hp = $hpForm->get('entity_hp')->getData();

            $encounter->removeCharacter($tempEntity);
            if ($new_hp < $entity->getMaxHp())
                if ($new_hp > 0)
                    $entity->setHp($new_hp);
                else
                    $entity->setHp(0);
            else {
                $entity->setHp($entity->getMaxHp());
            }

            $encounter->addCharacter($entity);
            $entityManager->persist($encounter);
            $entityManager->flush();
            return $this->redirectToRoute('encountersgenerator');
        }

        if ($encounterRepository->tableIsEmpty()){
            $encounter = new Encounter();
            $entityManager->persist($encounter);
            $entityManager->flush();
        }
        else{
            $encounter = $encounterRepository->getFirst();
        }

        return $this->render('encounter/encounters-generator.html.twig', [
            'form' => $form->createView(),
            'hpForm' => $hpForm->createView(),
            'entities' => $encounter->getCharacters(),
        ]);
    }

    /**
     * @Route("/encountersgenerator/remove/{name}", name="encountersgenerator_remove")
     */
    public function removeFromEncounter(Request $request, EncounterRepository $encounterRepository, EntityManagerInterface $entityManager): Response
    {
        $encounter = $encounterRepository->getFirst();
        $entity = $encounter->getCharacterByName($request->attributes->get('name'));
        $encounter->removeCharacter($entity);
        $entityManager->persist($encounter);
        $entityManager->flush();
        return $this->redirectToRoute('encountersgenerator');
    }

     /**
     * @Route("/entity/search/ajax", name="entity_search_ajax", options={"expose"=true})
     */
    public function searchAjax(Request $request, PlayerRepository $playerRepository, CreatureRepository $creatureRepository)
    {
        $searchTerm = $request->query->get('term');

        $players = $playerRepository->findByName($searchTerm);
        $creatures = $creatureRepository->findByName($searchTerm);

        $entitys = array_merge($players, $creatures);

        $results = [];
        foreach ($entitys as $entity) {
            $class = get_class($entity);
            $type = explode("\\", $class)[2];
            $results[] = [
                'id' => $entity->getId(),
                'label' => $entity->getName(),
                'type' => $type
            ];
        }
        if (empty($results)) {
            $results[] = [
                'id' => 0,
                'label' => 'Aucun résultat',
                'type' => 'none',
            ];
        }

        return new JsonResponse($results);
    }

    private function manageHp(Request $request, EncounterRepository $encounterRepository, EntityManagerInterface $entityManager, $type): JsonResponse
    {
        $encounter = $encounterRepository->getFirst();
        $tempEntity = $encounter->getCharacters()[$request->attributes->get('num')];
        $entity = clone $tempEntity;
        $encounter->removeCharacter($tempEntity);
        $nb_hp = $request->attributes->get('nb');
        if ($type == 'add')
        {
            if (($entity->getHp() + $nb_hp)< $entity->getMaxHp())
                $entity->setHp($entity->getHp() + $nb_hp);
            else {
                $entity->setHp($entity->getMaxHp());
            }
        }
        else
        {
            if (($entity->getHp() - $nb_hp) > 0)
                $entity->setHp($entity->getHp() - $nb_hp);
            else {
                $entity->setHp(0);
            }
        }
        $encounter->addCharacter($entity);
        $entityManager->persist($encounter);
        $entityManager->flush();
        return new JsonResponse([
            'success' => true, 
            "hp" => $entity->getHp(), 
            "maxHp" => $entity->getMaxHp()
        ]);
    }

    /**
     * @Route("/encountersgenerator/subtract_hp/{num}/{nb}", name="subtract_hp")
     */
    public function subtractHp(Request $request, EncounterRepository $encounterRepository, EntityManagerInterface $entityManager): JsonResponse
    {
        return $this->manageHp($request, $encounterRepository, $entityManager, 'subtract');
    }

    /**
     * @Route("/encountersgenerator/add_hp/{num}/{nb}", name="add_hp")
     */
    public function addHp(Request $request, EncounterRepository $encounterRepository, EntityManagerInterface $entityManager): JsonResponse
    {
        return $this->manageHp($request, $encounterRepository, $entityManager, 'add');
    }

    private function buildDetrimentalState(string $name): DetrimentalState
    {
        $detrimentalState = new DetrimentalState();
        $detrimentalState->setName($name);
        switch ($name) {
            case 'weakened':
                $detrimentalState->setDescription("d12 pour tous les tests au lieu du d20");
                break;
            case 'blind':
                $detrimentalState->setDescription("Init. -5, Att. contact -5, DEF -5, Att. dist. -10");
                break;
            case 'stun':
                $detrimentalState->setDescription("Aucune action possible, DEF -5");
                break;
            case 'immobilized':
                $detrimentalState->setDescription("d12 pour tous les tests au lieu du d20, pas de déplacement");
                break;
            case 'paralyzed':
                $detrimentalState->setDescription("Aucune action possible, en cas d’attaque : touché automatiquement et subit un coup critique");
                break;
            case 'slow':
                $detrimentalState->setDescription("Une seule action par tour (action d’attaque ou de mouvement)");
                break;
            case 'reversed':
                $detrimentalState->setDescription("Att. -5, DEF -5, nécessite une action de mouvement pour se relever");
                break;
            case 'surprised':
                $detrimentalState->setDescription("Pas d’action, DEF -5 au 1er tour de combat");
                break;
            default:
                $detrimentalState->setDescription("");
                break;
        }
        return $detrimentalState;
    }

    /**
     * @Route("/encountersgenerator/detrimental_state/{num}/{state}", name="set_detrimental_state")
     */
    public function setDetrimentalState(Request $request, EncounterRepository $encounterRepository, EntityManagerInterface $entityManager)
    {
        $encounter = $encounterRepository->getFirst();
        $tempEntity = $encounter->getCharacters()[$request->attributes->get('num')];
        $entity = clone $tempEntity;
        $encounter->removeCharacter($tempEntity);
        $entity->manageDetrimentalStates($this->buildDetrimentalState($request->attributes->get('state')));
        $encounter->addCharacter($entity);
        $entityManager->persist($encounter);
        $entityManager->flush();
        return $this->redirectToRoute('encountersgenerator');
    }

     /**
     * @Route("/encounter/create/{nc}", name="encounter_create")
     */
    public function createEncounter(Request $request, CreatureRepository $createuRepository) : Response
    {
        $form = $this->createForm(NumberType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            return $this->redirectToRoute('encounter_create', ['nc' => $form->getData()['number']]);
        }
        $creatures = $createuRepository->findAllBellowNc($request->get('nc'));
        return $this->render('encounter/encounter-create.html.twig', [
            'creatures' => $creatures,
            'form' => $form->createView(),
            'nc' => $request->get('nc')
        ]);
    }

    // public function playerlistOrdered(Request $request, PlayerRepository $playerRepository): Response
    // {
    //     $players = $playerRepository->findAllOrderBy($request->get('by'), $request->get('asc'));
    //     return $this->playerlist($request, $playerRepository, $players);
    // }

    //-----------------------------------------------------------------------------------//

    // Equipement
    //-----------------------------------------------------------------------------------//
    /**
     * @Route("/equipment/contact-weapon", name="contact_weapon")
     */
    public function contactWeapon(){
        return $this->render('equipment/contact-weapon.html.twig');
    }
    /**
     * @Route("/equipment/distance-weapon", name="distance_weapon")
     */
    public function distanceWeapon(){
        return $this->render('equipment/distance-weapon.html.twig');
    }

    /**
     * @Route("/equipment/armor", name="armor")
     */
    public function armor(){
        return $this->render('equipment/armor.html.twig');
    }
    //-----------------------------------------------------------------------------------//
}