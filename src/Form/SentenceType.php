<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\Sentence;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * Description of SentenceType
 */
class SentenceType extends AbstractType
{
    /**
     * 
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choicesFamily = array();
        foreach ($options['familyMembers'] as $familyMember) {
            $choicesFamily[$familyMember->getRole()] = $familyMember;
        }

        $builder
            ->add('sentence', TextType::class, array(
                'label' => 'Mot pour bébé',
            ))
            ->add('familyMember', ChoiceType::class, array(
                'required' => true,
                'label' => 'Mot de :',
                'choices' => $choicesFamily
            ))
            ->add('save', SubmitType::class, array('label' => 'Continuer'));
    }
    
    /**
     * 
     * @para OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Sentence::class,
            'familyMembers' => array(),
        ));
    }
}
