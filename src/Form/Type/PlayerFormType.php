<?php

namespace App\Form\Type;

use App\Entity\Player;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Range;

class PlayerFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, [
            'attr' => ['class' => 'form-control'],
            'label' => 'Nom du personnage',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('class', TextType::class, [
            'attr' => ['class' => 'form-control'],
            'label' => 'Profils',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('level', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 1
            ],
            'label' => 'Niveau',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('race', TextType::class, ['attr' => ['class' => 'form-control']]);
        $builder->add('sexe', TextType::class, ['attr' => ['class' => 'form-control']]);
        $builder->add('age', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 1
            ],
        ]);
        $builder->add('height', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 1
            ],
            'label' => 'Taille (en cm)',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('weight', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 1
            ],
            'label' => 'Poids (en kg)',
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
        $builder->add('magic_int', CheckboxType::class, [
            'required' => false,
            'attr' => ['class' => 'form-check-input'],
            'label' => 'Magie en Intelligence',
            'label_attr' => ['class' => 'form-check-label']
        ]);
        $builder->add('magic_sag', CheckboxType::class, [
            'required' => false,
            'attr' => ['class' => 'form-check-input'],
            'label' => 'Magie en Sagesse',
            'label_attr' => ['class' => 'form-check-label']
        ]);
        $builder->add('magic_cha', CheckboxType::class, [
            'required' => false,
            'attr' => ['class' => 'form-check-input'],
            'label' => 'Magie en Charisme',
            'label_attr' => ['class' => 'form-check-label']
        ]);
        $builder->add('bonus_init', IntegerType::class, [
            'mapped' => false,
            'attr' => [
                'class' => 'form-control',
                'min' => 0
            ],
            'label' => 'Bonus à l\'initiative',
            'label_attr' => ['class' => 'form-label']
        ]);

        $builder->add('dice_life', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 4,
                'max' => 12,
                'step' => 2
            ],
            'label' => 'Dés de vie',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('max_hp', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 1
            ],
            'label' => 'Points de vie max',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('hp', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 1
            ],
            'label' => 'Points de vie actuels',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('def', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' =>0
            ],
            'label' => 'Défense apportée par l\'armure et autres bonus',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('racial_skil', TextareaType::class, [
            'attr' => ['class' => 'form-control'],
            'label' => 'Capacité raciale',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('languages', CollectionType::class, [ 
            'entry_type' => LanguageType::class,
            'entry_options' => ['label' => false],
            'allow_add' => true,
            'by_reference' => false,
            'allow_delete' => true,
            'label' => '',
            'label_attr' => ['class' => 'd-none']
        ]);

        for ($i = 1; $i <= 3; $i++) {
            $builder->add('weapon'. $i .'_name', TextType::class, [
                'mapped' => false,
                'attr' => ['class' => 'form-control'],
                'label' => 'Nom de l\'arme  '. $i,
                'label_attr' => ['class' => 'form-label']
            ]);
            $builder->add('weapon'. $i .'_att', IntegerType::class, [
                'mapped' => false,
                'attr' => [
                    'class' => 'form-control',
                    'min' => 0
                ],
                'label' => 'Bonus d\'attaque de l\'arme '. $i,
                'label_attr' => ['class' => 'form-label']
            ]);
            $builder->add('weapon'. $i .'_dm', TextType::class, [
                'mapped' => false,
                'attr' => ['class' => 'form-control'],
                'label' => 'Dégâts de l\'arme '. $i,
                'label_attr' => ['class' => 'form-label']
            ]);
            $builder->add('weapon'. $i .'_special', TextType::class, [
                'mapped' => false,
                'required' => false,
                'attr' => ['class' => 'form-control'],
                'label' => 'Spécial de l\'arme '. $i,
                'label_attr' => ['class' => 'form-label']
            ]);
        }

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
        $builder->add('inventory', CollectionType::class, [ 
            'entry_type' => InventoryItemType::class,
            'entry_options' => ['label' => false],
            'allow_add' => true,
            'by_reference' => false,
            'allow_delete' => true,
            'label' => '',
            'label_attr' => ['class' => 'd-none']
        ]);
        $builder->add('clutter', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 0
            ],
            'label' => 'Encombrement',
            'label_attr' => ['class' => 'form-label']
        ]);

        $builder->add('max_pc', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 0
            ],
            'label' => 'Points de chance max',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('pc', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 0
            ],
            'label' => 'Points de chance actuels',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('max_pr', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 0
            ],
            'label' => 'Points de récupération max',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('pr', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 0
            ],
            'label' => 'Points de récupération actuels',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('max_pm', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 0
            ],
            'label' => 'Points de mana max',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('pm', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 0
            ],
            'label' => 'Points de mana actuels',
            'label_attr' => ['class' => 'form-label']
        ]);

        $builder->add('pa', IntegerType::class, [
            'mapped' => false,
            'attr' => [
                'class' => 'form-control',
                'min' => 0
            ],
            'label' => 'Pièce d\'argent',
            'label_attr' => ['class' => 'form-label'],
            'constraints' => [
                new Range([
                    'min' => 0,
                    'notInRangeMessage' => 'La valeur doit être supérieur à {{ min }}.'
                ])
            ]
        ]);
        $builder->add('po', IntegerType::class, [
            'mapped' => false,
            'attr' => [
                'class' => 'form-control',
                'min' => 0
            ],
            'label' => 'Pièce d\'or',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('att_con', IntegerType::class, [
            'disabled' => true,
            'data' => 0,
            'attr' => [
                'style' => 'display: none;'
            ],
            'label' => ''
        ]);
        $builder->add('att_mag', IntegerType::class, [
            'disabled' => true,
            'data' => 0,
            'attr' => [
                'style' => 'display: none;'
            ]
        ]);
        $builder->add('att_dis', IntegerType::class, [
            'disabled' => true,
            'data' => 0,
            'attr' => [
                'style' => 'display: none;'
            ]
        ]);
        $builder->add('init', IntegerType::class, [
            'disabled' => true,
            'data' => 0,
            'attr' => [
                'style' => 'display: none;'
            ]
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

        $builder->add('detrimental_states', CollectionType::class, [ 
            'entry_type' => DetrimentalStateType::class,
            'disabled' => true,
            'attr' => [
                'style' => 'display: none;'
            ]
        ]);

        $builder->add('em', IntegerType::class, [
            'mapped' => false,
            'attr' => [
                'class' => 'form-control',
                'min' => 0
            ],
            'label' => 'Épuisement magique',
            'label_attr' => ['class' => 'form-label']
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Player::class,
            ]
        );
    }
}