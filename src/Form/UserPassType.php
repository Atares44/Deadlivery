<?php


namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserPassType  extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('oldPassword', PasswordType::class,[
            'label' => 'Mot de passe actuel',
        ]);
        $builder->add('password', RepeatedType::class, array(
            'type' => PasswordType::class,
            'invalid_message' => 'Les champs doivent être identiques',
            'required' => true,
            'first_options'  => array('label' => 'Mot de passe'),
            'second_options' => array('label' => 'Confirmation'),
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}