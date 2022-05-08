<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserAdminType;
use App\Form\UserRoleType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


#[Route('/admin/user')]

class UserController extends AbstractController
{

    
    #[Route("/")]
    
    public function index(UserRepository $userRepos)
    {
        $users = $userRepos->findAll();

        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }

    
    /**
     * 
     * @Route("/{id}", requirements={"id"="\d+"})     *      
     * Composant ParamConverter capable de traduire un param de route en :
     * Entité
     * \DateTime
     */
    public function show(User $user, UserRepository $userRepository)
    {
        $user = $userRepository->findClientWithOrders($user->getId());
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    
    #[Route('/new')]
    
    public function new(
        Request $request,
        EntityManagerInterface $manager,
        UserPasswordEncoderInterface $passwordEncoder
    ){
            $user = new User();
            $form = $this->createForm(UserAdminType::class, $user);

            $form->handleRequest($request); // hydrate l'objet

            if ($form->isSubmitted() && $form->isValid()) {
                // encodage du password
                $user->setPassword($passwordEncoder->encodePassword(
                    $user,
                    $user->getPassword()
                ));

                // persistance des données en base
                $manager->persist($user);
                // planification de tâches a effectuer
                $manager->flush();

                // Messages stockés en session php => s'efface dés le 1er accès en lecture
                $this->addFlash('success', 'Compte créé');

                //Redirection
                return $this->redirectToRoute('app_admin_user_show', [
                    'id' => $user->getId(),
                ]);
            }

            return $this->render('user/new.html.twig', [
                'user' => $user,
                'new_form' => $form->createView(),
            ]);
    }

    
    #[Route('/editRole/{id}')]
    
    public function editRole(User $user, Request $request, EntityManagerInterface $manager)
    {
        $isClient = false;

        $roles = $user->getRoles();
        foreach($roles as $role){
            if($role == "ROLE_CLIENT"){
                $isClient = true;
            }
        }

        //Si ce n'est pas un client
        //Car l'admin peut uniquement modifier les roles des gestionnaires et admins
        if(!$isClient) {
            $form = $this->createForm(UserRoleType::class, $user, [
                'method' => 'PUT',
            ]);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $manager->persist($user);
                $manager->flush();

                $this->addFlash('message', 'Rôle de l\'utilisateur modifié avec succès');
                return $this->redirectToRoute('app_admin_user_show', [
                    'id' => $user->getId(),
                ]);
            }

            return $this->render('user/editRole.html.twig', [
                'user' => $user,
                'userForm' => $form->createView(),
            ]);
        }else{
            $this->addFlash('message', 'Vous ne pouvez pas modifier le rôle un client.');
            return $this->redirectToRoute('app_admin_user_show',[
                'id' => $user->getId(),
            ]);
        }
    }

    
    #[Route('/delete/{id}', methods: ['GET'])]
    
    public function delete(User $user, EntityManagerInterface $manager){
        $isClient = false;

        $roles = $user->getRoles();
        foreach($roles as $role){
            if($role == "ROLE_CLIENT"){
                $isClient = true;
            }
        }

        //Si ce n'est pas un client, on supprime
        if(!$isClient){
            $manager->remove($user);
            $manager->flush();

            // Redirection
            $this->addFlash('message', 'Utilisateur supprimé avec succès');
            return $this->redirectToRoute('app_admin_user_index');
        }else{
            $this->addFlash('message', 'Vous ne pouvez pas supprimer un client.');
            return $this->redirectToRoute('app_admin_user_show',[
                'id' => $user->getId(),
            ]);
        }
    }
}
