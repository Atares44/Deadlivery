<?php

namespace App\Controller;

use App\Entity\Products;
use App\Repository\ProductsRepository;
use App\Repository\ServicesTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    
    #[Route('/')]
    
    public function index(ProductsRepository $repository, ServicesTypeRepository $servicesTypeRepository)
    {
        $services = $servicesTypeRepository->findAll();

        if($this->getUser() != null) {
            if ($this->getUser()->getRoles()[0] === "ROLE_CLIENT") {
                $zombies = $repository->findAllAvailable();
            } else {
                $zombies = $repository->findAll();
            }
        } else {
            $zombies = $repository->findAllAvailable();
        }

        return $this->render('products/index.html.twig', [
            'products' => $zombies,
            'services' => $services
        ]);
    }

    /**
     * 
     * @Route("/products/{id}", requirements={"id"="\d+"})
     * Composant ParamConverter capable de traduire un param de route en :
     * Entité
     * \DateTime
     */
    public function show(Products $zombie, Request $request, ProductsRepository $productsRepository)
    {
        $zombieWhithNotes = $productsRepository->findAllNotes($zombie->getId());

        if ($zombie->getproductStatus() != "Available") {
            
            $this->addFlash('warning', 'Le produit n\'est pas disponible');
            return $this->redirectToRoute("app_products_index");
            
        }

        else if($zombie->getproductStatus() === "Available"){

            /*$etag = md5($zombie->getProductName().$zombie->getProductDesc());
            $response = new Response();
            $response->setEtag($etag);
            if ($response->isNotModified($request)){
                return $response;
            }*/            

            return $this->render('products/show.html.twig', [
                'product' => $zombieWhithNotes,
            ]);

        } 
    }
    
    #[Route('/updateProductListAvailable', methods: ['GET'])]
     
    /** 
     * @param Request $request
     * @return JsonResponse
     */
    public function updateProductListAvailable(Request $request)
    {
        // Entity manager et repository
        $em = $this->getDoctrine()->getManager();
        $productRepository = $em->getRepository(Products::class);

        if($this->getUser() != null) {
            if ($this->getUser()->getRoles()[0] === "ROLE_CLIENT") {
                // Recherche des produits qui correspondent au service_id passé en GET
                $products = $productRepository->findAllAvailableWithServId($request->query->get("serviceId"));
            } else {
                // Recherche des produits qui correspondent au service_id passé en GET
                $products = $productRepository->findAllWithServId($request->query->get("serviceId"));
            }
        } else {
            // Recherche des produits qui correspondent au service_id passé en GET
            $products = $productRepository->findAllAvailableWithServId($request->query->get("serviceId"));
        }

        // Données sérialisé dans un tableau avec l'id et le nom du produit
        $responseArray = [];
        foreach ($products as $product) {
            $responseArray[] = [
                'id' => $product->getId(),
                'productImg' => $product->getProductImg(),
                'productName' => $product->getProductName(),
                'productNature' => $product->getProductNature(),
                'averageNote' => $product->getAverageNote(),
                'productNature' => $product->getProductNature()
            ];
        }

        // array to Json
        return new JsonResponse($responseArray);

    }
}
