<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Form\InventoryItemType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class InventoryForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
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
    }
}