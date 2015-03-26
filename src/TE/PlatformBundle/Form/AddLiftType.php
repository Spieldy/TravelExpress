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
            ->add('fromCity', 'text')
            ->add('toCity', 'text')
            ->add('dateLift', 'datetime')
            ->add('price', 'number')
            ->add('seats', 'integer')
            ->add('Enregistrer', 'submit')
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
