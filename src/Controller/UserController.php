<?php

namespace App\Controller;

use App\Entity\Adress;
use App\Entity\Clients;
use App\Entity\User;
use App\Form\AdressType;
use App\Form\Model\ChangePassword;
use App\Form\UserAccountType;
use App\Form\UserPassType;
use App\Form\UserType;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

#[Route('/user')]

class UserController extends AbstractController
{

    #[Route('/createAccount')]
    
    public function new(
        Request $request,
        EntityManagerInterface $manager,
        UserPasswordEncoderInterface $passwordEncoder
    )
    {
        if($this->getUser()!==null){
            throw new \LogicException('compte déjà existant');
        } else {
            // Possible car on a nécessairement un utilisateur via contrôle d'accès
            //$zombie->setAuthoredBy($this->getUser());
            $user = new User();

            $form = $this->createForm(UserType::class, $user);

            $form->handleRequest($request); // hydrate l'objet

            if ($form->isSubmitted() && $form->isValid()) {
                // encodage du password
                $user->setPassword($passwordEncoder->encodePassword(
                    $user,
                    $user->getPassword()
                ));
                $adresses = $user->getUserAdresses();
                $compteur = 0;
                $adress = new Adress();

                //Le formulaire renvoie un tableau de string avec chaque information
                foreach($adresses as $userAdress){
                    switch($compteur){
                        case 0:
                            $adress->setAdressNumber($userAdress);
                            $compteur++;
                            break;
                        case 1:
                            $adress->setAdressStreet($userAdress);
                            $compteur++;
                            break;
                        case 2:
                            $adress->setAdressPostCode($userAdress);
                            $compteur++;
                            break;
                        case 3:
                            $adress->setAdressTown($userAdress);
                            $compteur++;
                            break;
                        case 4:
                            $adress->setAdressCountry($userAdress);
                            $compteur++;
                            break;
                    }

                }
                //Je vide les strings qui se sont ajoutés dans l'attribut adresses
                $user->removeAllUserAdress();
                //Et je rajoute l'adresse en tant qu'entité Adress
                $user->addUserAdress($adress);



                // persistance des données en base
                $manager->persist($adress);
                $manager->persist($user);
                // planification de tâches a effectuer
                $manager->flush();

                // Messages stockés en session php => s'efface dés le 1er accés en lecture
                $this->addFlash('success', 'Compte créé');

                //Redirection
                return $this->redirectToRoute('app_user_createclient', [
                    'id' => $user->getId(),
                ]);
            }

            return $this->render('user/new.html.twig', [
                'user' => $user,
                'new_form' => $form->createView(),
            ]);
        }
    }

    /**
     * 
     * @Route("/{id}/createClient", requirements={"id"="\d+"})
     *  
     */
    
    public function createClient(User $user, EntityManagerInterface $manager)
    {
        $client = new Clients();
        $client->setNbOrders(0);
        $client->setClientRank('zombNew');
        $client->setUser($user);
        $user->setClientAccount($client);

        // persistance des données en base
        $manager->persist($client);
        // planification de tâches a effectuer
        $manager->flush();

        //Redirection
        $this->addFlash('success', $user->getUsername().' Vous pouvez vous connecter');
        return $this->redirectToRoute('app_security_login');
    }

    #[Route('/member/account/show')]
    
    public function showAccount(UserRepository $userRepository)
    {
        $user = $userRepository->findClientWithOrders($this->getUser()->getId());
        $adresses = $user->getUserAdresses();

        return $this->render('user/user_account/show.html.twig', [
            'user' => $user,
            'adresses' => $adresses,
        ]);
    }
    
    #[Route('/member/account/edit')]
    
    public function editAccount(Request $request, EntityManagerInterface $manager)
    {
        $user = $this->getUser();
        $form = $this->createForm(UserAccountType::class, $user,[
                'method' => 'PUT',
            ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();

            $this->addFlash('success', $user->getUsername().' mis à jour');
            return $this->redirectToRoute('app_user_showaccount', [
                'id' => $user->getId(),
            ]);
        }

        return $this->render('user/user_account/edit.html.twig', [
            'user' => $user,
            'edit_form' => $form->createView(),
        ]);
    }

    #[Route('/member/account/editPass')]
    
    public function editPassword(Request $request,
                                 EntityManagerInterface $manager,
                                 UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = $this->getUser();
        $form = $this->createForm(UserPassType::class, $user,[
            'method' => 'PUT',
        ]);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            // encodage du password
            $user->setPassword($passwordEncoder->encodePassword(
                $user,
                $user->getPassword()
            ));

            $manager->flush();

            $this->addFlash('success', 'Votre mot de passe a bien été mis à jour');
            return $this->redirectToRoute('app_user_showaccount', [
                'id' => $user->getId(),
            ]);
        }

        return $this->render('user/user_account/editPass.html.twig', [
            'user' => $user,
            'edit_form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', methods: ['GET', 'PUT'])]
    
    public function editAdress(
        Adress $adress,
        Request $request,
        EntityManagerInterface $manager,
        UserRepository $userRepos){

        $user = $userRepos->findClientWithOrders($this->getUser()->getId());

        $form = $this->createForm(AdressType::class, $adress, [
            'method' => 'PUT',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();

            $this->addFlash('success', 'L\'adresse a bien été mise à jour');
            return $this->redirectToRoute('app_user_showaccount', [
                'id' => $user->getId(),
            ]);
        }

        return $this->render('adress/edit.html.twig', [
            'edit_form' => $form->createView(),
            'adress' => $adress,
        ]);
    }
}
