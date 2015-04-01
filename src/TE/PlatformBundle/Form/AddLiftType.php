<?php

namespace TE\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddLiftType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fromCity', 'text', array(
                'trim'   =>  true,
                'label'  => 'Ville de départ',
                'attr'   =>  array(
                    'placeholder'   => 'Ville de départ')
                ))
            ->add('toCity', 'text', array(
                'trim'   =>  true,
                'label'  => 'Ville d\'arrivée',
                'attr'   =>  array(
                    'placeholder'   => 'Ville d\'arrivée')
                ))
            ->add('dateLift', 'datetime', array( 
                'label'  => 'Date de départ'
                ))
<<<<<<< HEAD
            ->add('price', 'integer', array( 
=======
            ->add('frequency', 'choice', array(
                'choices'   => array('q' => 'Quotidien', 'h' => 'Hebdomadaire', 'm' => 'Mensuel'),
                'required'  => false,
                ))
            ->add('price', 'number', array( 
>>>>>>> 232a100354f48f4e64218cea4d4f0ba9c0801e36
                'label'  => 'Prix',
                'attr'   =>  array(
                    'placeholder'   => 'Prix',
                    'min' => '1',
                    'max' => '500')
                ))
            ->add('seats', 'integer', array( 
                'label'  => 'Places disponibles',
                'attr'   =>  array(
                    'placeholder'   => 'Places disponibles',
                    'min' => '1',
                    'max' => '6')
                ))
            ->add('Enregistrer', 'submit', array( 
                'label'  => 'Publier votre lift',
                'attr'   =>  array(
                    'class'   => 'Btn')
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TE\PlatformBundle\Entity\Lift'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'te_platformbundle_addLift';
    }
}
