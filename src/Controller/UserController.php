<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Manager\UserManager;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/users", name="user_list", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function list(UserRepository $userRepository): Response
    {
        return $this->render('user/list.html.twig', ['users' => $userRepository->findAll()]);
    }

    /**
     * @Route("/users/create", name="user_create", methods={"GET","POST"})
     */
    public function create(Request $request, UserManager $userManager, EntityManagerInterface $entityManager)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user, ['withRoleChoice' => true]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userManager->setPassword($user, $form->get('password')->getData());
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', "L'utilisateur a bien été ajouté.");

            return $this->redirectToRoute('user_list');
        }

        return $this->render('user/create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/users/{id}/edit", name="user_edit", methods={"GET","POST"})
     * @IsGranted("USER_EDIT", subject="user")
     */
    public function edit(User $user, Request $request, UserManager $userManager, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher)
    {
        $form = $this->createForm(UserType::class, $user, ['withRoleChoice' => true, 'passwordRequired' => false]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (null !== $form->get('password')->getData()) {
                $userManager->setPassword($user, $form->get('password')->getData());
            }
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', "L'utilisateur a bien été modifié");

            return $this->redirectToRoute('user_list');
        }

        return $this->render('user/edit.html.twig', ['form' => $form->createView(), 'user' => $user]);
    }
}
