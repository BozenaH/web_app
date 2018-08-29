<?php

/**
 *
 * This file is used to manage routes associated with course entity
 */
namespace App\Controller;

use App\Entity\Course;
use App\Form\CourseType;
use App\Repository\CourseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;

/**
 * class that controls any routes associated with the CourseController
 * @Route("/course")
 */
class CourseController extends Controller
{
    /**
     * @Route("/", name="course_index", methods="GET")
     */
    public function index(CourseRepository $courseRepository): Response
    {
        return $this->render('course/index.html.twig', ['courses' => $courseRepository->findAll()]);
    }

    /**
     * @Route("/list", name="course_list", methods="GET")
     */
    public function list(CourseRepository $courseRepository): Response
    {
        // we only show the courses that the user purchased
        $coursesIds = $this->getUser()->getPaidCourses();
        return $this->render('course/list.html.twig', ['courses' => $courseRepository->findById($coursesIds)]);

    }

    /**
     * @Route("/new", name="course_new", methods="GET|POST")
     *
     */

    public function new(Request $request): Response
    {
        $course = new Course();
        $form = $this->createForm(CourseType::class, $course);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // $file stores the uploaded PNG file

            $file = $course->getImage();
            $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();

            // moves the file to the directory where brochures are stored
            $file->move($this->getParameter('image_directory'), $fileName);
            $course->setImage($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($course);
            $em->flush();

            return $this->redirectToRoute('course_list');
        }

        return $this->render('course/new.html.twig', [
            'course' => $course,
            'form' => $form->createView(),
        ]);
    }
        /**
        * @return string
        */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }

    /**
     * @Route("/{id}", name="course_show", methods="GET")
     */
    public function show(Course $course): Response
    {
        return $this->render('course/show.html.twig', ['course' => $course]);
    }

    /**
     * @Route("/{id}/edit", name="course_edit", methods="GET|POST")
     */
    public function edit(Request $request, Course $course): Response
    {
        $form = $this->createForm(CourseType::class, $course);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            // $file stores the uploaded PNG file
            //$this->getDoctrine()->getManager()->flush();
            $file = $course->getImage();
            $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();

            // moves the file to the directory where images are stored
            $file->move($this->getParameter('image_directory'), $fileName);
            $course->setImage(
              $course->getImage()
            );
            $course->setImage($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($course);
            $em->flush();



            return $this->redirectToRoute('course_index');
        }

        return $this->render('course/edit.html.twig', [
            'course' => $course,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}", name="course_delete", methods="DELETE")
     */
    public function delete(Request $request, Course $course): Response
    {
        if ($this->isCsrfTokenValid('delete'.$course->getId(), $request->request->get('_token')))
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($course);
            $em->flush();
        }

        return $this->redirectToRoute('course_list');
    }

}
