<?php

namespace App\Controller;

use App\Repository\StudentRepository;
use App\Entity\Student;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class StudentController extends Controller
{
    /**
     * @Route("/student", name="student_list")
     */
    public function listAction()
    {
        $studentRepository = new StudentRepository();
        $students = $studentRepository->findAll();
        $template = 'student/list.html.twig';
        $args = [
            'students' => $students
        ];

        return $this->render($template, $args);
    }

    /**
     * @Route("/student/{id}", name="student_show")
     */
    public function showAction($id)
    {
        $studentRepository = new StudentRepository();
        $student = $studentRepository->find($id);

        $template = 'student/show.html.twig';
        $args = [
            'student' => $student
        ];
        return $this->render($template, $args);
    }

}