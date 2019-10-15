<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Family;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class FamilyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname', TextType::class, array(
                'label' => 'Nom',
                'required'   => true,
            ))
            ->add('firstname', TextType::class, array(
                'label' => 'Prénom',
                'required'   => true,
            ))
            ->add('birthdate', DateType::class, array(
                'label' => 'Date de naissance',
                'required' => true,
            ))
            ->add('role', ChoiceType::class, array(
                'required' => true,
                'label' => 'Lien de parenté',
                'choices' => array(
                    'Maman' => 'Maman',
                    'Papa' => 'Papa',
                    )
            ))
            ->add('isUser', ChoiceType::class, array(
                'required' => true,
                'label' => 'Est ce que l\'utilisateur est ce parent ?',
                'mapped' => false,
                'choices' => array(
                    'Oui' => true,
                    'Non' => false,
                    ),
                'disabled' => $options['userAlreadyDefined'],
                'preferred_choices' => array(false),
                'data' => $options['data']->isUser(),
            ))        
            
            ->add('save', SubmitType::class, array('label' => 'Continuer'))
            ->getForm();
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Family::class,
            'userAlreadyDefined' => false,
        ));
    }
}