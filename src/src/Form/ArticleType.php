<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\User;
use App\Repository\ArticleRepository;
use App\Repository\TagRepository;
use App\Repository\UserRepository;
use Doctrine\DBAL\Types\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use \Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ArticleType extends AbstractType
{
  private UserRepository $us;
  private TagRepository $tg;

  public function __construct(UserRepository $us , TagRepository $tg) {
    $this->us = $us;
    $this->tg = $tg;

  }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('price', IntegerType::class)
            ->add('description')
            ->add('pictures' )
            ->add('idUser', IntegerType::class, [
                'required' => $options['user']
            ] )
            ->add( 'submit', SubmitType::class );


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);

      $resolver->setRequired('user');

      // type validation - User instance or int, you can also pick just one.
      $resolver->setAllowedTypes('user', array(User::class, 'int'));

    }

}
