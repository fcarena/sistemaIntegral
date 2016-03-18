<?php

namespace LaFuente\CertificadoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;

class TipoRolPersonaType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $option)
    {
        $builder
            ->add('nombre', TextType::class, array('label' => 'Nombre'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LaFuente\CertificadoBundle\Entity\TipoRolPersona'
        ));
    }

    public function __toString(){
        return "LaFuente\CertificadoBundle\Form\TipoRolPersonaType";
    }
}
