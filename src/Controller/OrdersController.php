<?php

namespace App\Controller;

use App\Entity\Adress;
use App\Entity\Orders;
use App\Entity\Products;
use App\Entity\ServicesType;
use App\Entity\TempOrder;
use App\Form\AdressType;
use App\Form\OrdersType;
use App\Form\PaymentCardType;
use App\Form\TempOrdersType;
use App\Repository\ProductsRepository;
use App\Repository\ServicesTypeRepository;
use App\Repository\TempOrderRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\PaymentCard;


#[Route('/member/order')]

class OrdersController extends AbstractController
{

    /**
     * 
     * @Route("/{id}", requirements={"id"="\d+"})
     * Composant ParamConverter capable de traduire un param de route en :
     * Entité
     * \DateTime
     */
    public function show(Orders $order)
    {
        return $this->render('orders/show.html.twig', [
            'order' => $order,
        ]);
    }

    
    #[Route('/{id}/cancellation', methods: ['GET', 'PUT'])]
    
    public function cancellation(Orders $order, Request $request, EntityManagerInterface $manager)
    {
        $order->setOrderStatus('Cancel');

        // Récupération du produit loué
        $product = $order->getOrderProducts();

        $product->setProductStatus('Available');

        $form = $this->createForm(OrdersType::class, $order, [
            'method' => 'PUT',
        ]);

        $form->handleRequest($request);

        $manager->flush();

        return $this->redirectToRoute('app_orders_show', [
            'id' => $order->getId(),
        ]);
    }

    
    #[Route('/new/{id?}', methods: ['GET', 'POST'])]
    
    public function new(Request $request, EntityManagerInterface $manager, ServicesTypeRepository $servicesTypeRepository, TempOrderRepository $tempOrderRepository)
    {
        $dateNow = new \DateTime();
        $order = new Orders();
        $tempOrder = new TempOrder();

        // necessaire à la recup de l'id client
        $userName = $this->getUser()->getUsername();

        //var_dump($this->getUser());
        // Possible car on a nécessairement un utilisateur via contrôle d'accès
        //$zombie->setAuthoredBy($this->getUser());

        $form = $this->createForm(OrdersType::class, $order);

        $form->handleRequest($request); // hydrate l'objet

        if ($form->isSubmitted() && $form->isValid()) {

            $dateNowTwig = $_POST['dateNow'];
            $dateNowConvert = new \DateTime($dateNowTwig);

            if($tempOrder->verifTime($dateNow, $dateNowConvert)){

                //Redirection
                $this->addFlash('success', 'Le temps imparti pour finaliser la commande est écoulé');
                return $this->redirectToRoute('app_products_index');

            } else {

                // Récupération des données formulaire
                $post = $request->request->get('orders');
                // Date de début de location string => date
                $startDate = new \DateTime($post['orderStartDate']);
                // Date de fin de location string => date
                $endDate = new \DateTime($post['orderEndDate']);
                // Date de remise en location
                $availableDate = new \DateTime($post['orderEndDate']);
                $availableDate->modify("+7 days");
                // Id service & produit
                $servId = $post['orderService'];
                $prodId = $post['orderProducts'];
                $dispo = $post['orderDispo'];

                $dispoBack  = $tempOrderRepository->findByDate($prodId, $startDate, $endDate);
                if(!empty($dispoBack)) {
                    //Redirection
                    $this->addFlash('warning', 'Le produit n\'est pas disponible pour la période choisie');
                    return $this->redirectToRoute("app_orders_new");
                }

                // Récupération de l'objet service sélectionné
                $service = $servicesTypeRepository->find($servId);

                // Calcul de la différence entre date de début et date de fin de commande
                $diffDate = date_diff($startDate, $endDate)->format('%a');

                // Montant total de la commande
                $price = $service->getPrice() * $diffDate;

                // Setter tempOrder
                // Date du jour par défaut au chargement de la page
                $tempOrder->setTempOrderDate($dateNowConvert);
                // Status de la commande à New par défaut
                $tempOrder->setTempOrderStatus('New');
                // Creation de la référence produit
                $tempOrder->setTempOrderRef(date('YmdHis') . "_" . $userName);
                // Date de début de location
                $tempOrder->setTempStartDate($startDate);
                //Date de fin de location
                $tempOrder->setTempEndDate($endDate);
                //Date de remise en location
                $tempOrder->setAvailableDate($availableDate);
                // Id service
                $tempOrder->setTempOrderServId($servId);
                // Id product
                $tempOrder->setTempOrderProductId($prodId);
                // Montant total
                $tempOrder->setTempOrderPrice($price);

                //$manager->persist($client);
                // persistance des données en base
                $manager->persist($tempOrder);
                // planification de tâches a effectuer
                $manager->flush();

                //Redirection
                return $this->redirectToRoute('app_orders_shippingbillingaddress', [
                    'id' => $tempOrder->getId(),
                    'dateNowConvert' => $dateNowConvert
                ]);

            }

        }

        return $this->render('orders/temp_orders/new.html.twig', [
            'order' => $order,
            'dateNow' => $dateNow,
            'new_form' => $form->createView(),
        ]);
    }

    
    #[Route('/new/{id}/addressShippingBilling', methods: ['GET', 'POST'])]
    
    public function shippingBillingAddress(
                                                TempOrder $tempOrder,
                                                TempOrderRepository $tempOrderRepository,
                                                ProductsRepository $productsRepository,
                                                ServicesTypeRepository $servicesTypeRepository,
                                                UserRepository $userRepos,
                                                Request $request,
                                                EntityManagerInterface $manager
                                            )
    {
        //Récupération de l'user
        $username = $this->getUser()->getUsername();
        $userOrder = $userRepos->findWithIdClient($username);

        //Récupération de ses adresses
        $adresses = $userOrder->getUserAdresses();

        // Récupération de l'objet tempOrder
        $oneTempOrder = $tempOrderRepository->find($tempOrder->getId());

        // Récupération de l'objet service
        $oneService = $servicesTypeRepository->find($oneTempOrder->getTempOrderServId());

        //Récupération de l'objet produit
        $oneProduct = $productsRepository->find($oneTempOrder->getTempOrderProductId());

        //Le formulaire contenant les éléments pour la commande
        $formTempOrder = $this->createForm(TempOrdersType::class, $oneTempOrder);
        $formTempOrder->handleRequest($request); // hydrate l'objet

        //Le formulaire contenant les éléments pour la nouvelle adresse
        $adress = new Adress();
        $formNewAdress = $this->createForm(AdressType::class, $adress);
        $formNewAdress->handleRequest($request); // hydrate l'objet

        //Si le formulaire pour la création de la commande est validé
        if ($formTempOrder->isSubmitted() && $formTempOrder->isValid()) {

            $dateNow = new \DateTime();

            if($tempOrder->verifTime($dateNow, $tempOrder->getTempOrderDate())){

                //suppression temp_order de la base
                //Redirection
                $this->addFlash('success', 'Le temps imparti pour finaliser la commande est écoulé');
                return $this->redirectToRoute('app_orders_removetemporder',[
                    'id' => $tempOrder->getId()
                ]);

            } else {

                $idShipping = $_POST["idShippingAdresse"];
                $idBilling = $_POST["idBillingAdresse"];

                //Si la nouvelle adresse est utilisée en tant qu'adresse de livraison
                if ($idShipping == "-2" ||
                    ($idShipping == "-2" && $idBilling == "-2")) {
                    //On créé la nouvelle adresse et on lie l'entité user et adress
                    $adress->setAdressNumber($formTempOrder->get("tempShippingANumber")->getData());
                    $adress->setAdressStreet($formTempOrder->get("tempShippingAStreet")->getData());
                    $adress->setAdressPostCode($formTempOrder->get("tempShippingAPostCode")->getData());
                    $adress->setAdressTown($formTempOrder->get("tempShippingATown")->getData());
                    $adress->setAdressCountry($formTempOrder->get("tempShippingACountry")->getData());
                    $userOrder->addUserAdress($adress);
                    $manager->persist($adress);
                }


                //Si la nouvelle adresse est utilisée en tant qu'adresse de facturation
                if ($idBilling == "-2") {
                    //On créé la nouvelle adresse et on lie l'entité user et adress
                    $adress->setAdressNumber($formTempOrder->get("tempBillingANumber")->getData());
                    $adress->setAdressStreet($formTempOrder->get("tempBillingAStreet")->getData());
                    $adress->setAdressPostCode($formTempOrder->get("tempBillingAPostCode")->getData());
                    $adress->setAdressTown($formTempOrder->get("tempBillingATown")->getData());
                    $adress->setAdressCountry($formTempOrder->get("tempBillingACountry")->getData());
                    $userOrder->addUserAdress($adress);
                    $manager->persist($adress);
                }

                // persistance des données en base
                $manager->persist($userOrder);
                $manager->persist($tempOrder);
                // planification de tâches a effectuer
                $manager->flush();

                //Redirection
                return $this->redirectToRoute('app_orders_confirm', [
                    'id' => $oneTempOrder->getId(),
                ]);
            }
        }

        return $this->render('orders/temp_orders/addressChoice.html.twig', [
            'adresses' => $adresses,
            'tempOrder' => $oneTempOrder,
            'service' => $oneService,
            'product' => $oneProduct,
            'order_form_address' => $formTempOrder->createView(),
            'new_form_address' => $formNewAdress->createView(),
        ]);
    }

    
    #[Route('/new/{id}/confirm', methods: ['GET', 'POST'])]
    
    public function confirm
                            (
                                EntityManagerInterface $manager,
                                TempOrder $tempOrder,
                                TempOrderRepository $tempOrderRepository,
                                ProductsRepository $productsRepository,
                                ServicesTypeRepository $servicesTypeRepository,
                                UserRepository $userRepository,
                                Request $request
                            )
    {

        // email user
        $userName = $this->getUser()->getUsername();

        $paymentCard = new PaymentCard();
        // Récupération de l'objet tempOrder
        $oneTempOrder = $tempOrderRepository->find($tempOrder->getId());

        // Récupération de l'objet service
        $oneService = $servicesTypeRepository->find($oneTempOrder->getTempOrderServId());

        //Récupération de l'objet produit
        $oneProduct = $productsRepository->find($oneTempOrder->getTempOrderProductId());

        $form = $this->createForm(PaymentCardType::class, $paymentCard);

        $form->handleRequest($request); // hydrate l'objet

        if ($form->isSubmitted() && $form->isValid()) {

            $dateNow = new \DateTime();

            if ($tempOrder->verifTime($dateNow, $tempOrder->getTempOrderDate())) {

                //suppression temp_order de la base

                //Redirection
                $this->addFlash('success', 'Le temps imparti pour finaliser la commande est écoulé');
                return $this->redirectToRoute('app_orders_removetemporder',[
                    'id' => $tempOrder->getId()
                ]);
            } else {

                // Instantiation de la commande
                $orders = new Orders();

                // Récupération de l'id client depuis l'email utilisateur
                $user = $userRepository->findWithIdClient($userName);

                $client = $user->getClientAccount();

                // Récupération du nombre de commande de l'utilisateur
                $nbOrders = $client->getNbOrders();

                // Incrémentation de nombre de commandes de 1 après validation du paiement
                $nbOrders++;
                $client->setNbOrders($nbOrders);

                // Modification du rang du client
                if ($nbOrders === 10) {
                    $client->setClientRank("zombKnown");
                } elseif ($nbOrders === 20) {
                    $client->setClientRank("zombVIP");
                }

                // Hydratation de la commande depuis tempOrder
                $orders->setOrderDate($tempOrder->getTempOrderDate());
                $orders->setOrderProducts($oneProduct);
                $orders->setOrderService($oneService);
                $orders->setShippingANumber($tempOrder->getTempShippingANumber());
                $orders->setShippingAStreet($tempOrder->getTempShippingAStreet());
                $orders->setShippingAPostCode($tempOrder->getTempShippingAPostCode());
                $orders->setShippingATown($tempOrder->getTempShippingATown());
                $orders->setShippingACountry($tempOrder->getTempShippingACountry());
                $orders->setBillingANumber($tempOrder->getTempBillingANumber());
                $orders->setBillingAStreet($tempOrder->getTempBillingAStreet());
                $orders->setBillingAPostCode($tempOrder->getTempBillingAPostCode());
                $orders->setBillingATown($tempOrder->getTempBillingATown());
                $orders->setBillingACountry($tempOrder->getTempBillingACountry());
                $orders->setOrderRef($tempOrder->getTempOrderRef());
                $orders->setOrderStatus($tempOrder->getTempOrderStatus());
                $orders->setOrderStartDate($tempOrder->getTempStartDate());
                $orders->setOrderEndDate($tempOrder->getTempEndDate());
                $orders->setOrderPrice($tempOrder->getTempOrderPrice());
                $orders->setClient($client);

                // persistance des données en base
                $manager->persist($orders);
                //$manager->persist($tempOrder);

                // planification de tâches a effectuer
                $manager->flush();

                //Redirection
                $this->addFlash('success', 'Commande #' . $tempOrder->getTempOrderRef() . ' enregistrée ' . $userName . ' Merci de votre confiance');
                return $this->redirectToRoute('app_products_index');

            }
        }

        return $this->render('orders/temp_orders/paymentOrder.html.twig', [
            'tempOrder' => $oneTempOrder,
            'paymentCard' => $paymentCard,
            'service' => $oneService,
            'product' => $oneProduct,
            'new_form_confirm' => $form->createView()
        ]);
    }

    
    #[Route('/listproductsofservices', methods: ['GET'])]

     /**
     * @param Request $request
     * @return JsonResponse
     */
    public function listProductsOfServices(Request $request)
    {
        // Entity manager et repository
        $em = $this->getDoctrine()->getManager();
        $productRepository = $em->getRepository(Products::class);

        // Recherche des produits qui correspondent au service_id passé en GET
        $products = $productRepository->createQueryBuilder("p")
            ->where("p.productService = :servId")
            ->setParameter("servId", $request->query->get("serviceId"))
            ->getQuery()
            ->getResult();

        // Données sérialisé dans un tableau avec l'id et le nom du produit
        $responseArray = [];
        foreach ($products as $product) {
            $responseArray[] = [
                "id" => $product->getId(),
                "name" => $product->getProductName(),
                "status" => $product->getProductStatus()
            ];
        }

        // array to Json
        return new JsonResponse($responseArray);
    }
    
    #[Route('/serviceprice', methods: ['GET'])]
    
     /**
     * @param Request $request
     * @return JsonResponse
     */
    public function servicePrice(Request $request)
    {
        // Entity manager et repository
        $em = $this->getDoctrine()->getManager();
        $serviceRepository = $em->getRepository(ServicesType::class);

        // Recherche des produits qui correspondent au service_id passé en GET
        $services = $serviceRepository->createQueryBuilder("s")
            ->where("s.id = :servId")
            ->setParameter("servId", $request->query->get("serviceId"))
            ->getQuery()
            ->getResult();

        // Données sérialisé dans un tableau avec l'id et le nom du produit
        $responseArray = [];
        foreach ($services as $service) {
            $responseArray[] = [
                "price" => $service->getPrice(),
            ];
        }

        // array to Json
        return new JsonResponse($responseArray);
    }

    #[Route('/whatService', methods: ['GET'])]
    
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function whatService(Request $request)
    {
        // Entity manager et repository
        $em = $this->getDoctrine()->getManager();
        $productRepository = $em->getRepository(Products::class);

        // Recherche des produits qui correspondent au service_id passé en GET
        $products = $productRepository->createQueryBuilder("p")
            ->where("p.id = :productId")
            ->setParameter("productId", $request->query->get("productId"))
            ->getQuery()
            ->getResult();

        // Données sérialisé dans un tableau avec l'id et le nom du produit
        $responseArray = [];
        foreach ($products as $product) {
            $responseArray[] = [
                "id" => $product->getId(),
                "serviceId" => $product->getProductService()->getId()
            ];
        }

        // array to Json
        return new JsonResponse($responseArray);
    }
    
    #[Route('/recupadress', methods: ['GET'])]
     
     /**
     * @param Request $request
     * @return JsonResponse
     */
    public function recupadress(Request $request){
        // Entity manager et repository
        $em = $this->getDoctrine()->getManager();
        $adressRepository = $em->getRepository(Adress::class);
        $responseArray = [];
        $idAdressBilling = $request->query->get("adressBillingId");

        //Si l'utilisateur utilise la même adresse pour la livraison et la facturation
        if($idAdressBilling == null){
            // Recherche des produits qui correspondent au service_id passé en GET
            $adresses = $adressRepository->createQueryBuilder("a")
                ->where("a.id = :adressId")
                ->setParameter("adressId", $request->query->get("adressId"))
                ->getQuery()
                ->getResult();

            foreach ($adresses as $adress) {
                $responseArray[] = [
                    "adressNumber" => $adress->getAdressNumber(),
                    "adressStreet" => $adress->getAdressStreet(),
                    "adressPostCode" => $adress->getAdressPostCode(),
                    "adressTown" => $adress->getAdressTown(),
                    "adressCountry" => $adress->getAdressCountry(),
                ];
            }
        }else{
            // Recherche de l'adresse de livraison
            $adressesShipping = $adressRepository->createQueryBuilder("a")
                ->where("a.id = :adressId")
                ->setParameter("adressId", $request->query->get("adressShippingId"))
                ->getQuery()
                ->getResult();

            // Recherche de l'adresse de facturation
            $adressesBilling = $adressRepository->createQueryBuilder("a")
                ->where("a.id = :adressId")
                ->setParameter("adressId", $request->query->get("adressBillingId"))
                ->getQuery()
                ->getResult();

            $adressesShippingNumber = "";
            $adressesShippingStreet = "";
            $adressesShippingPostCode = "";
            $adressesShippingTown = "";
            $adressesShippingCountry = "";

            $adressesBillingNumber = "";
            $adressesBillingStreet = "";
            $adressesBillingPostCode = "";
            $adressesBillingTown = "";
            $adressesBillingCountry = "";

            foreach ($adressesShipping as $adress) {
                $adressesShippingNumber = $adress->getAdressNumber();
                $adressesShippingStreet = $adress->getAdressStreet();
                $adressesShippingPostCode = $adress->getAdressPostCode();
                $adressesShippingTown = $adress->getAdressTown();
                $adressesShippingCountry = $adress->getAdressCountry();
            }

            foreach ($adressesBilling as $adress) {
                $adressesBillingNumber = $adress->getAdressNumber();
                $adressesBillingStreet = $adress->getAdressStreet();
                $adressesBillingPostCode = $adress->getAdressPostCode();
                $adressesBillingTown = $adress->getAdressTown();
                $adressesBillingCountry = $adress->getAdressCountry();
            }

            $responseArray[] = [
                "adressShippingNumber" => $adressesShippingNumber,
                "adressShippingStreet" => $adressesShippingStreet,
                "adressShippingPostCode" => $adressesShippingPostCode,
                "adressShippingTown" => $adressesShippingTown,
                "adressShippingCountry" => $adressesShippingCountry,
                "adressBillingNumber" => $adressesBillingNumber,
                "adressBillingStreet" => $adressesBillingStreet,
                "adressBillingPostCode" => $adressesBillingPostCode,
                "adressBillingTown" => $adressesBillingTown,
                "adressBillingCountry" => $adressesBillingCountry,
            ];
        }


        // array to Json
        return new JsonResponse($responseArray);
    }

    
    #[Route('/removeTempOrder', methods: ['GET'])]
    
    public function removeTempOrder(TempOrderRepository $tempOrderRepository, EntityManagerInterface $em, Request $request)
    {
        $tempOrder = $tempOrderRepository->find($request->query->get('id'));

        $em->remove($tempOrder);
        $em->flush();

        //Redirection
        $this->addFlash('success', 'Le temps imparti pour finaliser la commande est écoulé');
        return $this->redirectToRoute('app_products_index');
    }

    
    #[Route('/cancelTempOrder', methods: ['GET'])]
    
    public function cancelTempOrder(TempOrderRepository $tempOrderRepository, EntityManagerInterface $em, Request $request)
    {
        $tempOrder = $tempOrderRepository->find($request->query->get('id'));

        $em->remove($tempOrder);
        $em->flush();

        //Redirection
        $this->addFlash('success', 'La commande a été annulée');
        return $this->redirectToRoute('app_products_index');
    }
    
    #[Route('/rentalDates', methods: ['GET'])]
     
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function rentalDates(Request $request)
    {
        // Entity manager et repository
        $em = $this->getDoctrine()->getManager();
        $tempOrderRepository = $em->getRepository(TempOrder::class);

        $rentalDates = $tempOrderRepository->findAllByProduct($request->query->get('prodId'));

        // Données sérialisé dans un tableau avec l'id et le nom du produit
        $responseArray = [];
        foreach ($rentalDates as $rentalDate) {
            $responseArray[] = [
                'startDate' => $rentalDate->getTempStartDate()->format("d/m/Y"),
                'endDate' => $rentalDate->getAvailableDate()->format("d/m/Y")
            ];
        }

        // array to Json
        return new JsonResponse($responseArray);
    }
    
    #[Route('/verifDispo', methods: ['GET'])]
     
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function verifDispo(Request $request)
    {
        // Entity manager et repository
        $em = $this->getDoctrine()->getManager();
        $tempOrderRepository = $em->getRepository(TempOrder::class);

        $id = $request->query->get('prodId');
        $startDate = $request->query->get('startDate');
        $endDate = $request->query->get('endDate');

        $rentalDates = $tempOrderRepository->findByDate($id, $startDate, $endDate);

        // Données sérialisé dans un tableau avec l'id et le nom du produit
        $datesArray = [];
        if(!empty($rentalDates)) {
            foreach ($rentalDates as $rentalDate) {
                $datesArray[] = [
                    'startDate' => $rentalDate->getTempStartDate(),
                    'availableDate' => $rentalDate->getAvailableDate(),
                    'dispo' => false
                ];
            }
        }else {
            $datesArray[] = [
                'dispo' => true
            ];
        }

        // array to Json
        return new JsonResponse($datesArray);
    }

}
