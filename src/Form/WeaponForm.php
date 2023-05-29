<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\{TextType, IntegerType};

class WeaponForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
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
        $builder->add('clutter', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 0
            ],
            'label' => 'Encombrement',
            'label_attr' => ['class' => 'form-label']
        ]);
    }
}