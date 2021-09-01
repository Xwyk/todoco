<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use phpDocumentor\Reflection\Types\Iterable_;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    // @TODO add view task route
    /**
     * @Route("/tasks", name="task_list")
     * @isGranted("TASKS_VIEW")
     * @param TaskRepository $repository
     * @return Response
     */
    public function list(TaskRepository $repository): Response
    {
        return $this->render('task/list.html.twig', ['tasks' => $repository->findAll()]);
    }

    /**
     * @Route("/tasks/create", name="task_create")
     * @isGranted("ROLE_USER")
     * @param Request $request
     * @param EntityManager $manager
     * @return RedirectResponse|Response
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(Request $request, EntityManagerInterface $manager)
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($task);
            $manager->flush();
            $this->addFlash('success', 'La tâche a été bien été ajoutée.');
            return $this->redirectToRoute('task_list');
        }
        return $this->render('task/create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/tasks/{id}/edit", name="task_edit")
     * @isGranted("TASK_EDIT", subject="task")
     * @param Task $task
     * @param Request $request
     * @param EntityManager $manager
     * @return RedirectResponse|Response
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function edit(Task $task, Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();
            $this->addFlash('success', 'La tâche a bien été modifiée.');
            return $this->redirectToRoute('task_list');
        }
        return $this->render('task/edit.html.twig', ['form' => $form->createView(), 'task' => $task,]);
    }

    /**
     * @Route("/tasks/{id}/toggle", name="task_toggle")
     * @isGranted("TASK_TOGGLE", subject="task")
     * @param Task $task
     * @param EntityManagerInterface $manager
     * @return RedirectResponse
     */
    public function toggle(Task $task, EntityManagerInterface $manager): RedirectResponse
    {
        $task->setIsDone(!$task->getIsDone());
        $manager->flush();

        $this->addFlash('success', sprintf('La tâche %s a bien été marquée comme faite.', $task->getTitle()));

        return $this->redirectToRoute('task_list');
    }

    /**
     * @Route("/tasks/{id}/delete", name="task_delete")
     * @isGranted("TASK_DELETE", subject="task")
     * @param Task $task
     * @param EntityManager $manager
     * @return RedirectResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete(Task $task, EntityManagerInterface $manager): RedirectResponse
    {
        $manager->remove($task);
        $manager->flush();

        $this->addFlash('success', 'La tâche a bien été supprimée.');

        return $this->redirectToRoute('task_list');
    }
}
