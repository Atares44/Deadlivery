<?php

namespace App\Form;

use App\Entity\ServicesType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServicesFormUpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('serviceName',TextType::Class,[
                'label' => 'Nom du service'])
            ->add('serviceDesc',TextareaType::Class,[
                'label' => 'Description du service'])
            ->add('price', NumberType::class)
            ->add('serviceTypeStatus', ChoiceType::class, [
                'label' => 'Statut actuel du produit',
                'choices' => [
                    'Disponible' => 'Available',
                    'Indisponible' => 'nonAvailable',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ServicesType::class,
        ]);
    }
}
