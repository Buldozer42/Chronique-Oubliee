<?php

namespace App\Form;

use App\Entity\Creature;
use App\Form\AttackType;
use App\Form\SpecialSkillType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreatureFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('name', TextType::class, [
            'attr' => ['class' => 'form-control'],
            'label' => 'Nom',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('family', TextType::class, [
            'attr' => ['class' => 'form-control'],
            'label' => 'Famile de créature',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('type', ChoiceType::class, [
            'attr' => ['class' => 'form-control form-select'],
            'choices'  => [
                'Vivante' => 'Vivante',
                'Non-vivante' => 'Non-vivante',
                'Humanoïde' => 'Humanoïde',
                'Végétative' => 'Végétative',
            ],
            'label' => 'Type de créature',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('size', ChoiceType::class, [
            'attr' => ['class' => 'form-control form-select'],
            'choices'  => [
                'Minuscule' => 'Minuscule',
                'Très petite' => 'Très petite',
                'Petite' => 'Petite',
                'Moyenne' => 'Moyenne',
                'Grande' => 'Grande',
                'Énorme' => 'Énorme',
                'Colossale' => 'Colossale',
            ],
            'label' => 'Taille',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('natural_environment', ChoiceType::class, [
            'attr' => ['class' => 'form-control form-select'],
            'choices'  => [
                'Aucun' => 'Aucun',
                'Aquatique' => 'Aquatique',
                'Désertique' => 'Désertique',
                'Forêt' => 'Forêt',
                'Marécage' => 'Marécage',
                'Montagne' => 'Montagne',
                'Plaine' => 'Plaine',
                'Souterrain' => 'Souterrain',
                'Toundra' => 'Toundra',
                'Urbain' => 'Urbain',
                'Spécial' => 'Spécial',
            ],
            'label' => 'Environnement naturel',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('archetype', ChoiceType::class, [
            'attr' => ['class' => 'form-control form-select'],
            'choices'  => [
                'Standard' => 'Standard',
                'Inférieur' => 'Inférieur',
                'Rapide' => 'Rapide',
                'Puissant' => 'Puissant',
            ],
            'label' => 'Archétype',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('boss_rank', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 0,
                'max' => 5
            ],
            'label' => 'Rang de boss',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('boss_type', ChoiceType::class, [
            'attr' => ['class' => 'form-control form-select'],
            'choices'  => [
                'Aucun' => 'Aucun',
                'Standard' => 'Standard',
                'Berserk' => 'Berserk',
                'Rapide' => 'Rapide',
                'Puissant' => 'Puissant',
            ],
            'label' => 'Type de boss',
            'label_attr' => ['class' => 'form-label']
        ]);

        $builder->add('nc', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 0
            ],
            'label' => 'Niveau de créature',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('max_hp', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 1
            ],
            'label' => 'Points de vie maximum',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('hp', IntegerType::class, [
            'disabled' => true,
            'data' => 0,
            'attr' => [
                'style' => 'display: none;'
            ]
        ]);
        $builder->add('def', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 0
            ],
            'label' => 'Défense',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('init', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 1
            ],
            'label' => 'Initiative',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('fo', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 1
            ],
            'label' => 'Valeur en Force',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('dex', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 1
            ],
            'label' => 'Valeur en Dextérité',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('con', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 1
            ],
            'label' => 'Valeur en Constitution',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('int', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 1
            ],
            'label' => 'Valeur en Intelligence',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('sag', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 1
            ],
            'label' => 'Valeur en Sagesse',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('cha', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 1
            ],
            'label' => 'Valeur en Charisme',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('advantage_fo', CheckboxType::class, [
            'required' => false,
            'attr' => ['class' => 'form-check-input'],
            'label' => 'Avantage en Force',
            'label_attr' => ['class' => 'form-check-label']
        ]);
        $builder->add('advantage_dex', CheckboxType::class, [
            'required' => false,
            'attr' => ['class' => 'form-check-input'],
            'label' => 'Avantage en Dextérité',
            'label_attr' => ['class' => 'form-check-label']
        ]);
        $builder->add('advantage_con', CheckboxType::class, [
            'required' => false,
            'attr' => ['class' => 'form-check-input'],
            'label' => 'Avantage en Constitution',
            'label_attr' => ['class' => 'form-check-label']
        ]);
        $builder->add('advantage_int', CheckboxType::class, [
            'required' => false,
            'attr' => ['class' => 'form-check-input'],
            'label' => 'Avantage en Intelligence',
            'label_attr' => ['class' => 'form-check-label']
        ]);
        $builder->add('advantage_sag', CheckboxType::class, [
            'required' => false,
            'attr' => ['class' => 'form-check-input'],
            'label' => 'Avantage en Sagesse',
            'label_attr' => ['class' => 'form-check-label']
        ]);
        $builder->add('advantage_cha', CheckboxType::class, [
            'required' => false,
            'attr' => ['class' => 'form-check-input'],
            'label' => 'Avantage en Charisme',
            'label_attr' => ['class' => 'form-check-label']
        ]);
        $builder->add('rd', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 0
            ],
            'label' => 'Réduction des dommages',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('rd_comment', TextType::class, [
            'attr' => ['class' => 'form-control'],
            'label' => 'Comentaire (ex : radiant)',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('description', TextareaType::class, [
            'attr' => ['class' => 'form-control'],
            'label' => 'Description',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('story', TextareaType::class, [
            'attr' => ['class' => 'form-control'],
            'label' => 'Histoire',
            'label_attr' => ['class' => 'form-label']
        ]);

        $builder->add('attacks', CollectionType::class, [ 
            'entry_type' => AttackType::class,
            'entry_options' => ['label' => false],
            'allow_add' => true,
            'by_reference' => false,
            'allow_delete' => true,
            'label' => '',
            'label_attr' => ['class' => 'd-none']
        ]);

        for ($i = 1; $i <= 6; $i++) {
            $builder->add('path'. $i .'_name', TextType::class, [
                'mapped' => false,
                'attr' => ['class' => 'form-control path'.$i.'_name path'.$i.'disabled'],
                'label' => 'Nom de la voie '. $i,
            ]);
            for ($y = 1; $y <= 5; $y++) {
                $builder->add('path'. $i .'_comp'. $y .'_name', TextType::class, [
                    'mapped' => false,
                    'attr' => ['class' => 'form-control path'. $i .'_comp'. $y .'_name path'.$i.'disabled'],
                    'label' => 'Nom de la cappacité '. $y .' de la voie '. $i,
                ]);
                $builder->add('path'. $i .'_comp'. $y .'_desc', TextareaType::class, [
                    'mapped' => false,
                    'attr' => ['class' => 'form-control path'. $i .'_comp'. $y .'_desc path'.$i.'disabled'],
                    'label' => 'Decription de la cappacité '. $y .' de la voie '. $i,
                ]);
            }
        }
        $builder->add('special_skills', CollectionType::class, [ 
            'entry_type' => SpecialSkillType::class,
            'entry_options' => ['label' => false],
            'allow_add' => true,
            'by_reference' => false,
            'allow_delete' => true,
            'label' => '',
            'label_attr' => ['class' => 'd-none']
        ]);
        $builder->add('detrimental_states', CollectionType::class, [ 
            'entry_type' => DetrimentalStateType::class,
            'disabled' => true,
            'attr' => [
                'style' => 'display: none;'
            ]
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => Creature::class,
            ]
        );
    }
}