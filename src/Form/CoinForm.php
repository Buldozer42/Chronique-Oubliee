<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Form\Type\InventoryItemType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class CoinForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('pa', IntegerType::class, [
            'mapped' => false,
            'attr' => [
                'class' => 'form-control',
                'min' => 0
            ],
            'label' => 'Pièce d\'argent',
            'label_attr' => ['class' => 'form-label'],
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
    }
}