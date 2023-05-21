<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class LevelUpForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('new_pv', IntegerType::class, [
                'label' => 'Nouveau nombre de pv',
                'required' => false,
                'attr' => [
                    'min' => 1,
                    'class' => 'form-control',
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
    }
}