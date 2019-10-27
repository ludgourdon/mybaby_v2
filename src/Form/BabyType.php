<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Baby;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class BabyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastName', TextType::class, array(
                'label' => 'Nom',
                'required'   => true,
            ))
            ->add('firstName', TextType::class, array(
                'label' => 'Prénom',
                'required'   => true,
            ))
            ->add('nickName', TextType::class, array(
                'label' => 'Surnom',
                'required'   => true,
            ))
            ->add('sex', ChoiceType::class, array(
                'label' => 'Sexe',
                'choices' => array(
                    'Garçon' => 'M',
                    'Fille' => 'F',
                    )
                )
            )
            ->add('save', SubmitType::class, array('label' => 'Continuer'))
            ->getForm();
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Baby::class,
        ));
    }
}