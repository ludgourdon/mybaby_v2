<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Event;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * class event type.
 */
class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {      
        $builder
            ->add('name', TextType::class, array(
                'label' => 'Nom',
                'required'   => true,
            ))
            ->add('place', TextType::class, array(
                'label' => 'Lieu',
                'required'   => true,
            ))
            ->add('date', DateType::class, array(
                'label' => 'Date',
                'required' => true,
            ))
            ->add('save', SubmitType::class, array('label' => 'Continuer'))
            ->getForm();
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Event::class
        ));
    }
}