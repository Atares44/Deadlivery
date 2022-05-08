<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ClientsController extends AbstractController
{
    
    #[Route('/admin/clients', name:'clients')]
     
    public function index()
    {
        return $this->render('clients/index.html.twig', [
            'controller_name' => 'ClientsController',
        ]);
    }
}
