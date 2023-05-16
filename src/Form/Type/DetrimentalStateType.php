<?php
namespace App\Form\Type;

use App\Entity\DetrimentalState;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DetrimentalStateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('name', TextType::class, [
            'attr' => ['class' => 'mx-2'],
            'label' => 'Nom : ',
            'label_attr' => ['class' => 'form-label']
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DetrimentalState::class,
        ]);
    }
}