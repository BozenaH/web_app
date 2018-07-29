<?php

namespace App\Controller;
use App\Repository\StudentRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class StudentController extends Controller
{
    /**
     * @Route("/student/list", name="student_list")
     */

    public function listAction()
    {
        $studentRepository = new StudentRepository();
        $students = $studentRepository->findAll;

        $template = 'student/list.html.twig';
        $arg = [
            'students' => $students
        ];
        return $this->render($template, $arg);

    }
}