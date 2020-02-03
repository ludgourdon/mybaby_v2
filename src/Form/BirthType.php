<?php

namespace App\Form;

use App\Entity\Birth;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class BirthType
 */
class BirthType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     *
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('birthDate', DateType::class, [
                'widget' => 'single_text',
                'html5' => true,
                'attr' => ['v-model' => 'birthDate'],
                'label' => 'Date de naissance'
            ])
            ->add('birthPlace', TextType::class, [
                'attr' => ['v-model' => 'birthPlace'],
                'label' => 'Lieu de naissance'
            ])
            ->add('birthHour', TimeType::class, [
                'widget' => 'single_text',
                'html5' => true,
                'attr' => ['v-model' => 'birthHour'],
                'label' => 'Heure de naissance'
            ])
            ->add('birthHeight', NumberType::class, [
                'attr' => ['v-model' => 'birthHeight'],
                'label' => 'Taille de naissance'
            ])
            ->add('birthWeight', NumberType::class, [
                'attr' => ['v-model' => 'birthWeight'],
                'label' => 'Poids de naissance'
            ])
            ->add('eyeColor', TextType::class, [
                'attr' => ['v-model' => 'eyeColor'],
                'label' => 'Couleur des yeux'
            ])
            ->add('hairy')
            ->add('hairColor')
            ->add('whoImLookingLike')
            ->add('whyDoILookLike')
            ->add('comments')
            ->add('save', SubmitType::class, array('label' => 'Continuer'));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Birth::class,
        ]);
    }
}
