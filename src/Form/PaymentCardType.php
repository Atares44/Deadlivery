<?php

namespace App\Form;

use App\Entity\PaymentCard;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaymentCardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cardNumber', null, array(
                "label" => "Numéro de carte",
            ))
            ->add('cardMonth', ChoiceType::class, array(
                "label" => "Mois d'expiration de votre carte",
                'choices' => [
                   "01" => "01", "02" => "02", "03" => "03", "04" => "04", "05" => "05", "06" => "06", "07" => "07", "08" => "08", "09" => "09", "10" => "10", "11" => "11", "12" => "12"
                ]
            ))
            ->add('cardYear', ChoiceType::class, array(
                "label" => "Année d'expiration de votre carte",
                'choices' => [
                    "20" => "20", "21" => "21", "22" => "22", "23" => "23", "24" => "24"
                ]
            ))
            ->add('cardSecurityCode', null, array(
                "label" => "Code de sécurité",
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PaymentCard::class,
        ]);
    }
}
