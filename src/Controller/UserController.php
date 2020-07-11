<?php

namespace App\Controller;

use App\Entity\User;
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
        if ('POST' == $request->getMethod()) {
            $created_at = new DateTime('now');
            $user = new User();
            $user->setLogin($request->get('login'));
            $user->setLast_Name($request->get('last_name'));
            $user->setFirst_Name($request->get('first_name'));
            $user->setCreated_At($created_at);
            $user->setUpdated_At($created_at);

            $entityManagerInterface->persist($user);
            $entityManagerInterface->flush();

            return $this->redirectToRoute('index');
        } else {
            $user = new User('');
        }
        return $this->render('user/create.html.twig', [
            'user' => $user,
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
        if ('POST' == $request->getMethod()) {
            $updated_at = new DateTime('now');
            $user->setLogin($request->get('login'));
            $user->setLast_Name($request->get('last_name'));
            $user->setFirst_Name($request->get('first_name'));
            $user->setUpdated_At($updated_at);
            //Save the edited values to DB:
            $entityManagerInterface->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
        ]);
    }
}