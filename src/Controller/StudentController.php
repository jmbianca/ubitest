<?php


namespace App\Controller;


use App\Entity\Grade;
use App\Entity\Student;
use App\Form\StudentType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class StudentController extends AbstractController
{

    /**
     * List of all students
     * @Route("/", methods={"GET"}, name="homepage")
     *
     * @return Response
     */
    public function index()
    {
        $list_students = $this->getDoctrine()
            ->getRepository(Student::class)
            ->findAll();

        return $this->render('homepage.html.twig', ['students' => $list_students]);
    }

    /**
     * Create a student
     * @Route("/student/create", methods={"GET", "POST"}, name="student_create")
     *
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $student = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($student);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Edit a student
     * @Route("/student/edit/{id}", methods={"GET", "POST"}, name="student_edit")
     *
     * @param Student $student
     * @param Request $request
     * @return Response
     */
    public function edit(Student $student, Request $request)
    {
        $form = $this->createForm(StudentType::class, $student);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $student = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($student);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        $grades = $student->getGrades();

        return $this->render('edit.html.twig', [
            'form' => $form->createView(),
            'student' => $student,
            'grades' => $grades,
        ]);
    }

    /**
     * Delete a student
     * @Route("/student/delete/{id}", methods={"GET"}, name="student_delete")
     *
     * @param Student $student
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Student $student)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($student);
        $em->flush();

        return $this->redirectToRoute('homepage');
    }
}
