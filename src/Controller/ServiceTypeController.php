<?php

namespace App\Controller;

use App\Entity\ServicesType;
use App\Repository\ServicesTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Request;

#[Route('/member/service-type')]

class ServiceTypeController extends AbstractController
{
    #[Route('/', methods: ['GET', 'POST'])]
    
    public function index(ServicesTypeRepository $servicesRepos)
    {
        $services = $servicesRepos->findAll();

        return $this->render('service_type/index.html.twig', [
            'services_type' => $services,
        ]);
    }

    /**
     * 
     * @Route("/{id}", requirements={"id"="\d+"})
     *  
     */
    
    public function show(ServicesType $servicesType, Request $request, ValidatorInterface $validator, ServicesTypeRepository $servicesRepos)
    {
        $servicesType = $servicesRepos->findWithZombies($servicesType->getId());

        return $this->render('service_type/show.html.twig', [
            'service_type' => $servicesType,
        ]);
    }

}