<?php
namespace App\Form\Type;

use App\Entity\Attack;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class AttackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('name', TextType::class, [
            'attr' => ['class' => 'mx-2'],
            'label' => 'Nom : ',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('bonus', IntegerType::class, [
            'attr' => [
                'class' => 'mx-2',
                'min' => 0,
            ],
            'label' => 'Bonus : ',
            'label_attr' => ['class' => 'form-label']
        ]);
        $builder->add('dm', TextType::class, [
            'attr' => ['class' => 'mx-2'],
            'label' => 'Dégâts : ',
            'label_attr' => ['class' => 'form-label']
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Attack::class,
        ]);
    }
}