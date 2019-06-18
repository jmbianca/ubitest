<?php


namespace App\Controller;


use App\Entity\Grade;
use App\Entity\Matter;
use App\Entity\Student;
use App\Form\GradeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GradeController extends AbstractController
{
    public function gradeForm(Student $student)
    {
        $grade = new Grade();
        $form = $this->createForm(GradeType::class, $grade);

        return $this->render('_grade_form.html.twig', [
            'student' => $student,
            'form' => $form->createView(),
        ]);
    }
    /**
     * Create a grade
     * @Route("/grade/create/{student_id}", methods={"POST"}, name="grade_create")
     * @ParamConverter("student", options={"mapping": {"student_id": "id"}})
     *
     * @param Student $student
     * @param Request $request
     * @return Response
     */
    public function create(Student $student, Request $request)
    {
//        dump($request);die;

        $grade = new Grade();
        $grade->setStudent($student);

        $post = $request->request->all();

        $form = $this->createForm(GradeType::class, $grade);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $grade = $form->getData();
            if ($grade->getNote() >= 0 && $grade->getNote() <= 20) {
                $em->persist($grade);
                $em->flush();
                $this->addFlash('success', 'La note a été ajoutée !');
            } else {
                $this->addFlash('error', 'La note est non valide !');
            }
        }

        return $this->redirectToRoute('student_edit', ['id' => $student->getId()]);
    }
}
