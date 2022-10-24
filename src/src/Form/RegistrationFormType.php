<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationFormType extends AbstractType {
  public function buildForm( FormBuilderInterface $builder, array $options )
  : void {
    $builder
        ->add( 'name', EmailType::class )
        ->add( 'email' )
        ->add( 'nickName' )
        ->add( 'surName' )
        ->add( 'avatar' )
        ->add( 'passwordForm', PasswordType::class, [
                'mapped' => false,
            ]
        )
        ->add( 'submit', SubmitType::class );
  }

  public function configureOptions( OptionsResolver $resolver )
  : void {
    $resolver->setDefaults( [
        'data_class' => User::class,
    ] );
  }
}