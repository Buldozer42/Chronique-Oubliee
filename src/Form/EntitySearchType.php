<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EntitySearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('search', SearchType::class, [
                'label' => 'Rechercher un truc',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Entrez un nom',
                    'class' => 'form-control search-input',
                    'autocomplete' => 'off',
                    'id' => 'entity_search_search',
                ]
            ]);
        
        $builder->add('entity_id', IntegerType::class, [
            'required' => false,
            'attr' => [
                'id' => 'entity_search_entity_id',
                'style' => 'display: none;'
            ]
        ]);

        $builder->add('entity_type', TextType::class, [
            'required' => false,
            'attr' => [
                'id' => 'entity_search_entity_type',
                'style' => 'display: none;'
            ]
        ]);
    }
}