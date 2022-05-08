<?php

namespace App\Form;

use App\Entity\Clients;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('clientRank',null, array(
                "label"=> "Rang du client",
            ))
            ->add('nbOrders', null, array(
                "label"=> "Nombre de commandes passées",
            ))
            ->add('user', null, array(
                "label"=> "Utilisateur",
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Clients::class,
        ]);
    }
}
