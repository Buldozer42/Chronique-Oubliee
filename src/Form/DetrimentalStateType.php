<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class DetrimentalStateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('description', TextareaType::class, [
            'required' => false,
            'attr' => [
                'class' => 'form-control detrimental-description',
                'placeholder' => "Description de l'état",
            ],
            'label' => 'Description : ',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('entity_num', TextType::class, [
            'required' => false,
            'attr' => [
                'style' => 'display:none',
                'placeholder' => 'Num de l\'entité',
                'class' => 'form-control detrimental-entity-num',
            ],
        ]);
    }
}