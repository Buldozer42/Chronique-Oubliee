<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class PointForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('hp', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 1
            ],
            'label' => 'Points de vie actuels',
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
        $builder->add('pr', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'min' => 0
            ],
            'label' => 'Points de récupération actuels',
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
}