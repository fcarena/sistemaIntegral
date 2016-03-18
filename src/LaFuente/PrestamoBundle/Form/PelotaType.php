<?php

namespace LaFuente\PrestamoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class PelotaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('identifier')
            ->add('estado',
             ChoiceType::class, array(
                                    'choices'  => array(
                                        'Bueno' => 'Bueno',
                                        'Regular' => 'Regular',
                                        'Malo' => 'Malo',
                                        'Roto' => 'Roto'),
                                    'label' => 'Estado')
             )
            ->add('availability')
            ->add('notes')
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LaFuente\PrestamoBundle\Entity\Pelota'
        ));
    }
}
