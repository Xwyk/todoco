<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class TaskController extends AbstractController
{
    /**
     * @Route("/tasks", name="task_list", methods={"GET"})
     * @IsGranted("TASKS_LIST")
     */
    public function list(Security $security, TaskRepository $repository, Request $request): Response
    {
        $finished = (bool) $request->query->get('finished');

        return $this->render('task/list.html.twig', [
                'tasks' => $repository->findByUserState($this->getUser(), $security->isGranted('ROLE_ADMIN'), $finished),
            ]);
    }

    /**
     * @Route("/tasks/create", name="task_create", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     *
     * @param EntityManager $manager
     *
     * @return RedirectResponse|Response
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(Request $request, EntityManagerInterface $manager)
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getUser()->addTask($task);
            $manager->persist($task);
            $manager->flush();
            $this->addFlash('success', 'La tâche a été bien été ajoutée.');

            return $this->redirectToRoute('task_list');
        }

        return $this->render('task/create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/tasks/{id}/edit", name="task_edit", methods={"GET","POST"})
     * @IsGranted("TASK_EDIT", subject="task")
     *
     * @param EntityManager $manager
     *
     * @return RedirectResponse|Response
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function edit(Task $task, Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($task);
            $manager->flush();
            $this->addFlash('success', 'La tâche a bien été modifiée.');

            return $this->redirectToRoute('task_list');
        }

        return $this->render('task/edit.html.twig', ['form' => $form->createView(), 'task' => $task]);
    }

    /**
     * @Route("/tasks/{id}/toggle", name="task_toggle", methods={"PUT"})
     * @IsGranted("TASK_TOGGLE", subject="task")
     *
     * @return RedirectResponse
     */
    public function toggle(Task $task, EntityManagerInterface $manager): Response
    {
        $task->toggleState();
        $manager->persist($task);
        $manager->flush();

        return new Response('OK', Response::HTTP_OK);
    }

    /**
     * @Route("/tasks/{id}/delete", name="task_delete", methods={"DELETE"})
     * @IsGranted("TASK_DELETE", subject="task")
     *
     * @param EntityManager $manager
     *
     * @return RedirectResponse
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete(Task $task, EntityManagerInterface $manager): Response
    {
        $manager->remove($task);
        $manager->flush();

        return new Response('OK', Response::HTTP_NO_CONTENT);
    }
}
