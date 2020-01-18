<?php

namespace App\Form;

use App\Entity\Birth;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BirthType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('birthDate', DateType::class, [
            'widget' => 'single_text',
            'html5' => false,
        ]);

        $builder
//            ->add('birthDate')
            ->add('birthPlace')
            ->add('birthHour')
            ->add('birthHeight')
            ->add('birthWeight')
            ->add('eyeColor')
            ->add('hairy')
            ->add('hairColor')
            ->add('whoImLookingLike')
            ->add('whyDoILookLike')
            ->add('comments')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Birth::class,
        ]);
    }
}
