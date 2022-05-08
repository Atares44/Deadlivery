<?php


namespace App\Form;


use App\Entity\Adress;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdressType  extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('adressNumber', TextType::class, array(
                "label" => "Numéro de rue",
                "required" => true,
                ))
            ->add('adressStreet', TextType::class, array(
                "label" => "Nom de rue",
                "required" => true,
            ))
            ->add('adressPostCode', TextType::class, array(
                "label" => "Code postal",
                "required" => true,
                ))
            ->add('adressTown',TextType::class , array(
                "label" => "Ville",
                "required" => true,
                ))
            ->add('adressCountry', TextType::class, array(
                "label" => "Pays",
                "required" => true,
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adress::class,
        ]);
    }
}