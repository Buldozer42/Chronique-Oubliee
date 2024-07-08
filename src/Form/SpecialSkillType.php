<?php
namespace App\Form;

use App\Entity\SpecialSkill;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class SpecialSkillType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('name', TextType::class, [
            'attr' => ['class' => 'mx-2'],
            'label' => 'Nom : ',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('description', TextareaType::class, [
            'attr' => ['class' => 'mx-2'],
            'label' => 'Description : ',
            'label_attr' => ['class' => 'form-label']
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SpecialSkill::class,
        ]);
    }
}