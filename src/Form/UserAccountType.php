<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserAccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userPseudo', TextType::class,[
                'label' => 'Pseudo',
            ])
            ->add('userMail', EmailType::class,[
                'label' => 'Email',
                ])
            ->add('userSurname', TextType::class,[
                'label' => 'Nom de famille',
            ])
            ->add('userName', TextType::class,[
                'label' => 'Prénom',
            ])
            ->add('userTel', TextType::class,[
                'label' => 'Téléphone',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
