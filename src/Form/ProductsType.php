<?php

namespace App\Form;

use App\Entity\Products;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProductsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('productName', null, array(
                "label" => "Nom du produit",
            ))
            ->add('productDesc', TextareaType::class, array(
                "label" => "Description du produit",
            ))
            ->add('productNature', ChoiceType::class, [
                'label' => "Nature du zombie",
                'choices' => [
                    'Amorphe' => 'amorphe',
                    'Accommodant' => 'accommodant',
                    'Agressif' => 'agressif'
                ]
            ])
            ->add('productService', null, array(
                "label" => "Service du produit",
            ))
            ->add('productImg', null, [
                'label' => "Image du produit",
                'attr' => [
                    'placeholder' => 'Veuillez indiquer le nom de l\'image sans l\'extention, placée dans le dossier assets/images'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
}
