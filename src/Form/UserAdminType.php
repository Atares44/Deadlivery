<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class UserAdminType extends UserType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('roles', ChoiceType::class, [
            'choices' => [
                'Gestionnaire' => 'ROLE_GESTIONNAIRE',
                'Administrateur' => 'ROLE_ADMIN',
            ],
            'expanded' => true,
            'multiple' => true,
            'required' => true,
            'label' => 'Rôle de l\'utilisateur',
        ]);
    }

}