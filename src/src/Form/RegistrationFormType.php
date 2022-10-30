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
        ->add( 'name', null, [
		  'attr' => array(
			'class' => 'form-control'
		  )])
        ->add( 'email',EmailType::class,[
			'attr' => array(
			  'class' => 'form-control'
			)]  )
        ->add( 'nickName', null, [
			'attr' => array(
			  'class' => 'form-control'
			)] )
        ->add( 'surName', null, [
			'attr' => array(
			  'class' => 'form-control'
			)] )
        ->add( 'avatar', null, [
			'attr' => array(
			  'class' => 'form-control'
			)] )
        ->add( 'passwordForm', PasswordType::class, [
                'mapped' => false,
				'attr' => array(
					'class' => 'form-control'
				  )
            ]
        )
        ->add( 'submit', SubmitType::class, [
			'attr' => array(
			  'class' => 'form-control secondary_cta'
			)] );
  }

  public function configureOptions( OptionsResolver $resolver )
  : void {
    $resolver->setDefaults( [
        'data_class' => User::class,
    ] );
  }
}
