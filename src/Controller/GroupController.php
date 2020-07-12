<?php

namespace App\Controller;

use App\Entity\Group;
use App\Entity\User;
use App\Type\GroupType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Clas GroupController
 * @package App\Controller
 */

class GroupController extends AbstractController
{
    /**
     * @param EntityManagerInterface $entityManagerInterface
     * @return Response
     * @Route(path="/group", name="group")
     */
    public function index(EntityManagerInterface $entityManagerInterface): Response
    {
        $repository = $entityManagerInterface->getRepository(Group::class);
        $groups = $repository->findAll();
        return $this->render('group/index.html.twig', [
            'groups' => $groups,
        ]);
    }

    /**
     * @param EntityManagerInterface $entityManagerInterface
     * @param Request $request
     * @return Response
     * @Route(path="/group/create")
     */
    public function create(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $group = new Group('');
        $form = $this->createForm(GroupType::class, $group);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManagerInterface->persist($group);
            $entityManagerInterface->flush();
            $this->addFlash('success', 'Grupa o nazwie ' . $group->getName() . ' została pomyśłnie dodana');
            return $this->redirectToRoute('group');
        }

        return $this->render('group/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param int $id
     * @param EntityManagerInterface $entityManagerInterface
     * @return Response
     * @Route(path="/group/delete/{id}")
     */
    public function delete(int $id, EntityManagerInterface $entityManagerInterface): Response
    {
        $repository = $entityManagerInterface->getRepository(Group::class);
        $group = $repository->find($id);
        $entityManagerInterface->remove($group);
        $entityManagerInterface->flush();
        $this->addFlash('danger', 'Grupa o nazwie ' . $group->getName() . ' została usunięta');

        return $this->redirectToRoute('group');
    }

    /**
     * @param Group $group
     * @param EntityManagerInterface $entityManagerInterface
     * @param Request $request
     * @return Response
     * @Route(path="/group/edit/{id}")
     */
    public function edit(Group $group, EntityManagerInterface $entityManagerInterface, Request $request): Response
    {
        $form = $this->createForm(GroupType::class, $group);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManagerInterface->persist($group);
            $entityManagerInterface->flush();
            $this->addFlash('info', 'Grupa o nazwie ' . $group->getName() . ' została pomyśłnie z edytowana');
            return $this->redirectToRoute('group');
        }

        return $this->render('group/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}