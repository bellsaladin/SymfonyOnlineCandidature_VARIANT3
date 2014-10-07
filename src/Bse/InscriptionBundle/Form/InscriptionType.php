<?php

namespace Bse\InscriptionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class InscriptionType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cin')
            ->add('cne')
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('adresse')
            ->add('telMobile')
            ->add('telFixe')
            ->add('noteS1')
            ->add('noteS2')
            ->add('noteS3')
            ->add('noteS4')
            ->add('noteS5')
            ->add('noteS6')
            ->add('filiere1')
            ->add('filiere2')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bse\InscriptionBundle\Entity\Inscription'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bse_inscriptionbundle_inscription';
    }
}
