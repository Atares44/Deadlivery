<?php

namespace App\Form;

use App\Entity\Orders;
use App\Entity\Products;
use App\Entity\ServicesType;
use App\Entity\TempOrder;
use App\Repository\ServicesTypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class OrdersType extends AbstractType
{
    private $em;

    /**
     * OrdersType constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->addEventListener(FormEvents::PRE_SET_DATA,
                [$this, 'onPreSetData']);

        $builder->addEventListener(FormEvents::PRE_SUBMIT,
                [$this, 'onPreSubmit']);

        $builder->add('orderStartDate', DateType::class, [
                    'label' => "Date de début de location",
                    'required' => true,
                    'html5' => true,
                    'widget' => 'single_text',
                    'attr' => [
                        'min' => date('Y-m-d'),
                    ]
                ])
                ->add('orderEndDate', DateType::class, [
                    'label' => "Date de fin de location",
                    'html5' => true,
                    'required' => true,
                    'widget' => 'single_text',
                    'attr' => [
                        'min' => 'orderStartDate',
                    ]
                ])
                ->add('orderPrice', HiddenType::class)
                ->add('orderDispo', HiddenType::class,
                    [
                        'attr' => [
                            'value' => "true"
                        ]
                    ]
                );

    }

    protected function addElements(FormInterface $form, ServicesType $service = null) {
        $servicesTypeRepository = $this->em->getRepository(ServicesType::class);
        $services = $servicesTypeRepository->findAllAvailable();
        $form->add('orderService', EntityType::class, [
            'label' => 'Service du zombie',
            'required' => true,
            'choices' => $services,
            'placeholder' => 'Choisissez un service...',
            'class' => ServicesType::class
            ]);

        $products = [];

        if ($service) {
            $productRepo = $this->em->getRepository(Products::class);

            $products = $productRepo->createQueryBuilder("p")
                ->where("p.productService = :servId")
                ->setParameter("servId", $service->getId())
                ->getQuery()
                ->getResult();
        }

        $form->add('orderProducts', EntityType::class, [
            'label' => 'Produit souhaité',
            'required' => true,
            'placeholder' => 'Choisissez dans un service avant...',
            'class' => Products::class,
            'choices' => $products
        ]);

    }

    function onPreSubmit(FormEvent $event) {
        $form = $event->getForm();
        $data = $event->getData();

        // Search for selected service and convert it into an Entity
        $service = $this->em->getRepository(ServicesType::class)->find($data['orderService']);

        $this->addElements($form, $service);
    }

    function onPreSetData(FormEvent $event) {
        $order = $event->getData();
        $form = $event->getForm();

        // When you create a new order, the service is always empty
        $service = $order->getOrderService() ? $order->getOrderService() : null;

        $this->addElements($form, $service);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Orders::class,
        ]);
    }
}
