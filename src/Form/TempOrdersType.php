<?php

namespace App\Form;

use App\Entity\TempOrder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TempOrdersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tempShippingANumber', TextType::class, [
                'label' => "Numéro de rue pour l'envoi",
                'required' => true
            ])
            ->add('tempShippingAStreet', TextType::class, [
                'label' => "Nom de rue pour l'envoi",
                'required' => true
            ])
            ->add('tempShippingAPostCode', NumberType::class, [
                'label' => "Code postal pour l'envoi",
                'required' => true
            ])
            ->add('tempShippingATown', TextType::class, [
                'label' => "Ville pour l'envoi",
                'required' => true
            ])
            ->add('tempShippingACountry', TextType::class, [
                'label' => "Pays pour l'envoi",
                'required' => true
            ])
            ->add('tempBillingANumber', TextType::class, [
                'label' => "Numéro de rue pour la facturation",
                'required' => true
            ])
            ->add('tempBillingAStreet', TextType::class, [
                'label' => "Nom de rue pour la facturation",
                'required' => true
            ])
            ->add('tempBillingAPostCode', NumberType::class, [
                'label' => "Code postal pour la facturation",
                'required' => true
            ])
            ->add('tempBillingATown', TextType::class, [
                'label' => "Ville pour la facturation",
                'required' => true
            ])
            ->add('tempBillingACountry', TextType::class, [
                'label' => "Pays pour la facturation",
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TempOrder::class,
        ]);
    }
}
