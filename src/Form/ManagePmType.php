<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ManagePmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('entity_pm', IntegerType::class, [
                'label' => '',
                'required' => false,
                'attr' => [
                    'min' => 0,
                    'placeholder' => 'Nombre de pm',
                    'class' => 'form-control entity-pm',
                ]
            ]);
        
        $builder->add('entity_num', TextType::class, [
            'required' => false,
            'attr' => [
                'style' => 'display:none',
                'placeholder' => 'Num de l\'entité',
                'class' => 'form-control mana-entity-num',
            ],
        ]);
    }
}