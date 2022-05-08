<?php

namespace App\Controller\Admin;

use App\Entity\Orders;
use App\Repository\OrdersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/admin/orders')]
 
class OrdersController extends AbstractController
{
    
    #[Route('/')]
    
    public function index(OrdersRepository $repository)
    {
        $orders = $repository->findAll();

        return $this->render('orders/index.html.twig', [
            'orders' => $orders
        ]);
    }

}