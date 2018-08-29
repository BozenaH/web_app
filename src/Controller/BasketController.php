<?php

namespace App\Controller;

use App\Entity\Course;
use App\Form\CourseType;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/basket")
 */
class BasketController extends Controller
{
    /**
     * @Route("/", name="basket_index")
     *
     */
    public function index()

    {
        if(!$this->isGranted('ROLE_USER'))
            return $this->redirectToRoute('login');

        else
        return $this->render('basket/index.html.twig', [
            'controller_name' => 'BasketController',
        ]);
    }
    /**
     * @Route("/clear", name="basket_clear")
     */
    public function clearAction()
    {
        $session = new Session();
        $session->remove('basket');

        return $this->redirectToRoute('basket_index');

    }
    /**
    * @Route("/add/{id}", name="basket_add")
     *
    */

    public function addToBasket(Course $course)
    {

            // default - new empty array
        $courses =[];

        // if 'products' array in session, retrieve and store
        $session = new Session();
        if ($session->has('basket')){
            $courses = $session->get('basket');
        }
        // get ID of the course
        $id = $course->getId();
        // only try to add.html.twig to array if not already in the array
        if (!array_key_exists($id,$courses)) {
            // append $product to our list
            $courses[$id] = $course;

            // store updated array back into the session
            $session->set('basket', $courses);
        }
        return $this->redirectToRoute('basket_index');
    }

    /**
     * @Route("/buy", name="basket_buy")
     */
    public function buy()
    {
        // default - new empty array
        $courses =[];
        $error = null;
        // if 'products' array in session, retrieve and store
        $session = new Session();
        if ($session->has('basket')){
            $courses = $session->get('basket');
        }
        if (!empty($courses)) {
            $user = $this->getUser();
            $paidCourses = [];
            foreach ($courses as $course) {
                $paidCourses[] = $course->getId();

                // we deduct the credit for the user
                $newCreditBalance = $user->getCreditBalance() - $course->getPrice();
                $user->setCreditBalance($newCreditBalance);
            }
            // here we check if the user can afford to buy the course
            if ($user->getCreditBalance() < 0) {
                $error = 'To low credit to buy this course';
            }
            //if there is no error
            if ($error == null) {
                // we retrieve id of the paid courses and we add to them id of the courses just bought
                // so that we don't lose the already purchased when buing next time
                $currentCourses = $user->getPaidCourses();
                $allCourses = array_merge($currentCourses, $paidCourses);
                // To avoid to keep adding same course few times
                $allCourses = array_unique($allCourses);
                $user->setPaidCourses($allCourses);
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
            }
        }
        // we empty the basket
        $session->set('basket', []);
       //return $this->redirectToRoute('basket_index', ['error' => $error]);
        return $this->render('basket/index.html.twig', [
            'controller_name' => 'BasketController',
            'error' => $error
        ]);
    }


    /**
     * @Route("/delete/{id}", name="basket_delete")
     */

    public function deleteAction(int $id)
    {
        // default - new empty array
        $courses = [];
        // if 'products' array in session, retrieve and store in $products
        $session = new Session();
        if ($session->has('basket')) {
            $courses = $session->get('basket');
        }
        // only try to add to array if not already in the array
        if (array_key_exists($id, $courses))
        {
            // remove entry with $id
            unset($courses[$id]);
            if (sizeof($courses) < 1) {
                return $this->redirectToRoute('basket_clear');
            }
            // store updated array back into the session
            $session->set('basket', $courses);
        }
        return $this->redirectToRoute('basket_index');
    }
}