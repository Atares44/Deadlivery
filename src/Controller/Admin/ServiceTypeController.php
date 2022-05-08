<?php

namespace App\Controller\Admin;

use App\Entity\ServicesType;
use App\Form\ServicesFormType;
use App\Form\ServicesFormUpdateType;
use App\Repository\ProductsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/service-type')]

class ServiceTypeController extends AbstractController
{

    
    #[Route('/{id}/edit', methods: ['GET', 'PUT'])]
    
    public function edit(
        ServicesType $serviceType,
        Request $request,
        EntityManagerInterface $manager){

        $form = $this->createForm(ServicesFormUpdateType::class, $serviceType, [
            'method' => 'PUT',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();

            $this->addFlash('success', $serviceType->getServiceName().' mis à jour');
            return $this->redirectToRoute('app_servicetype_show', [
                'id' => $serviceType->getId(),
            ]);
        }

        return $this->render('service_type/edit.html.twig', [
            'controller_name' => 'ServiceTypeController',
            'edit_form' => $form->createView(),
            'service_type' => $serviceType,
        ]);
    }

    
    #[Route('/new', methods: ['GET', 'POST'])]
    
    public function new(Request $request, EntityManagerInterface $manager)
    {
        $service_type = new ServicesType();

        $service_type->setServiceTypeStatus('Available');

        $form = $this->createForm(ServicesFormType::class, $service_type);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($service_type);
            $manager->flush();

            $this->addFlash('success', 'Nouveau service créé');
            return $this->redirectToRoute('app_servicetype_show', [
                'id' => $service_type->getId(),
            ]);
        }

        return $this->render('service_type/new.html.twig', [
            'controller_name' => 'ServiceTypeController',
            'new_form' => $form->createView(),
        ]);
    }

    
    #[Route('/delete/{id}', methods: ['GET'])]
    
    public function delete(ServicesType $serviceType, EntityManagerInterface $manager, ProductsRepository $productsRepository, Request $request)
    {
        $products = $productsRepository->findAllWithServId($serviceType->getId());

        if(!empty($products)) {
            $serviceType->setServiceTypeStatus('nonAvailable');
            foreach ($products as $product) {
                $product->setProductStatus('nonAvailable');
                $manager->persist($product);
            }
            $manager->persist($serviceType);
        } else {
            $manager->remove($serviceType);
        }


        $manager->flush();

        // Redirection
        return $this->redirectToRoute('app_servicetype_index');
    }

}
