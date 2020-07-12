<?php

namespace App\Controller;

use App\Entity\User;
use App\Type\UserType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Clas UserController
 * @package App\Controller
 * @Route(path="/")
 */

class UserController extends AbstractController
{
    /**
     * @param EntityManagerInterface $entityManagerInterface
     * @return Response
     * @Route(path="/", name="index")
     */
    public function index(EntityManagerInterface $entityManagerInterface): Response
    {
        $repository = $entityManagerInterface->getRepository(User::class);
        $users = $repository->findAll();
        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @param EntityManagerInterface $entityManagerInterface
     * @param Request $request
     * @return Response
     * @Route(path="/create")
     */
    public function create(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $user = new User('');
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManagerInterface->persist($user);
            $entityManagerInterface->flush();
            $this->addFlash('success', 'Osoba o imieniu ' . $user->getFirstName() . ' została pomyśłnie dodana');
            return $this->redirectToRoute('index');
        }

        return $this->render('user/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param int $id
     * @param EntityManagerInterface $entityManagerInterface
     * @return Response
     * @Route(path="/delete/{id}")
     */
    public function delete(int $id, EntityManagerInterface $entityManagerInterface): Response
    {
        $repository = $entityManagerInterface->getRepository(User::class);
        $user = $repository->find($id);
        $entityManagerInterface->remove($user);
        $entityManagerInterface->flush();
        $this->addFlash('danger', 'Osoba o imieniu ' . $user->getFirstName() . ' została usunięta');

        return $this->redirectToRoute('index');
    }

    /**
     * @param User $user
     * @param EntityManagerInterface $entityManagerInterface
     * @param Request $request
     * @return Response
     * @Route(path="/edit/{id}")
     */
    public function edit(User $user, EntityManagerInterface $entityManagerInterface, Request $request): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManagerInterface->persist($user);
            $entityManagerInterface->flush();
            $this->addFlash('info', 'Osoba o imieniu ' . $user->getFirstName() . ' została z edytowana.');
            return $this->redirectToRoute('index');
        }

        return $this->render('user/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}