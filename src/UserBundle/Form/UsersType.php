<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsersType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('uid')
            ->add('username')
            ->add('name')
            ->add('password')
            ->add('email', 'email')
            ->add('roles', 'choice', array('choices'=>array('ROLE_ADMIN'=>'Administrador','ROLE_USER'=>'User'), 'placeholder'=>'Select a Role'))
            ->add('isActive', 'checkbox')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Users'
        ));
    }
}
