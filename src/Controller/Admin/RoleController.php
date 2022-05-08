<?php

namespace App\Controller\Admin;

use App\Entity\Role;
use App\Entity\ServicesType;
use App\Form\RoleType;
use App\Repository\RoleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/admin/role')]

class RoleController extends AbstractController
{

    
    #[Route('/', methods: ['GET', 'POST'])]
    
    public function index(RoleRepository $roleRepos)
    {
        $roles = $roleRepos->findAll();

        return $this->render('role/index.html.twig', [
            'roles' => $roles,
        ]);
    }

    /**
     * 
     * @Route("/{id}", requirements={"id"="\d+"})
     *  
     */
    
    public function show(Role $role, RoleRepository $roleRepos)
    {
        $role = $roleRepos->findWithUsers($role->getId());

        return $this->render('role/show.html.twig', [
            'role' => $role,
        ]);
    }

    
    #[Route('/{id}/edit', methods: ['GET', 'PUT'])]
    
    public function edit(
        Role $role,
        Request $request,
        EntityManagerInterface $manager){

        $form = $this->createForm(RoleType::class, $role, [
            'method' => 'PUT',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();

            $this->addFlash('success', $role->getRoleName().' mis à jour');
            return $this->redirectToRoute('app_admin_role_show', [
                'id' => $role->getId(),
            ]);
        }

        return $this->render('role/edit.html.twig', [
            'edit_form' => $form->createView(),
            'role' => $role,
        ]);
    }


    
    #[Route('/new', methods: ['GET', 'POST'])]
    
    public function new(Request $request, EntityManagerInterface $manager)
    {
        $role = new Role();

        $form = $this->createForm(RoleType::class, $role);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($role);
            $manager->flush();

            $this->addFlash('success', 'Nouveau rôle créé');
            return $this->redirectToRoute('app_admin_role_show', [
                'id' => $role->getId(),
            ]);
        }

        return $this->render('role/new.html.twig', [
            'new_form' => $form->createView(),
        ]);
    }

    
    #[Route('/delete/{id}', methods: ['GET'])]
    
    public function delete(Role $role, EntityManagerInterface $manager)
    {
        $manager->remove($role);
        $manager->flush();

        // Redirection
        return $this->redirectToRoute('app_admin_role_index');
    }
}
