<?php

namespace App\Controller\Admin;

use App\Entity\Products;
use App\Form\ProductsType;
use App\Form\ProductsUpdateType;
use App\Repository\CommentsRepository;
use App\Repository\ProductsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/admin/products')]

class ProductsController extends AbstractController
{
    
    #[Route('/new', methods: ['GET','POST'])]

    public function new(Request $request, EntityManagerInterface $manager)
    {
        $zombie = new Products();
        // Possible car on a nécessairement un utilisateur via contrôle d'accès
        //$zombie->setAuthoredBy($this->getUser());

        $form = $this->createForm(ProductsType::class, $zombie);

        $form->handleRequest($request); // hydrate l'objet

        if ($form->isSubmitted() && $form->isValid()) {
            // Produit disponible à la création
            $zombie->setProductStatus('Available');
            // persistance des données en base
            $manager->persist($zombie);
            // planification de tâches a effectuer
            $manager->flush();

            // Messages stockés en session php => s'efface dés le 1er accés en lecture
            $this->addFlash('success', 'Nouveau produit créé');

            //Redirection
            return $this->redirectToRoute('app_products_show', [
                'id' => $zombie->getId(),
            ]);
        }

        return $this->render('products/new.html.twig', [
            'product' => $zombie,
            'new_form' => $form->createView(),
        ]);

    }

    
    #[Route('/{id}/edit', methods: ['GET', 'PUT'])]
    
    public function edit(Products $zombie, Request $request, EntityManagerInterface $manager)
    {
        // createFormBuilder sans methods en option => POST par defaut
        $form = $this->createForm(ProductsUpdateType::class, $zombie, [
            'method' => 'PUT',
        ]);

        $form->handleRequest($request); // hydrate l'objet

        if ($form->isSubmitted() && $form->isValid()) {
            // planification de tâches a effectuer
            $manager->flush();

            // Messages stockés en session php => s'efface dés le 1er accés en lecture
            $this->addFlash('success', 'Produit mis à jour');

            // Redirection
            return $this->redirectToRoute('app_products_show', [
                'id' => $zombie->getId(),
            ]);
        }

        return $this->render('products/edit.html.twig', [
            'product' => $zombie,
            'edit_form' => $form->createView(),
        ]);
    }

    
    #[Route('/delete/{id}', methods: ['GET'])]
    
    public function delete(Products $zombie, EntityManagerInterface $manager, CommentsRepository $commentsRepository)
    {
        // Suppression des commentaires liées au produit
        $comments = $commentsRepository->findBy(
            [
                "commentProduct" => $zombie->getId()
            ]
        );

        foreach ($comments as $comment){
            $manager->remove($comment);
        }

        // On garde le produit en base mais il est indisponible à la location
        $zombie->setProductStatus('nonAvailable');
        $manager->flush();

        // Redirection
        return $this->redirectToRoute('app_products_index');
    }
}
