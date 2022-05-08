<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userMail', EmailType::class, array("label" => "Mail"))
            ->add('password', PasswordType::class, array(
                'label_attr' => [
                    'name' => 'password'
                ],
                "label" => "Mot de passe"
            ))
            ->add('userFirstName', TextType::class, array("label" => "Prénom"))
            ->add('userSurname',TextType::class , array("label" => "Nom"))
            ->add('userPseudo', TextType::class, array("label" => "Pseudo"))
            ->add('userTel', TextType::class, array("label" => "Téléphone"))
            ->add('userTel', NumberType::class, array("label" => "Téléphone"))
            ->add('userAdresses',AdressType::class, array(
                "label" => "Votre adresse",
                "data_class" => null,
            )
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
