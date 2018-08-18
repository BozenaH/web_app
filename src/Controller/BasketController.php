<?php

namespace App\Controller;
use App\Entity\Course;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/basket")
 */
class BasketController extends Controller
{
    /**
     * @Route("/", name="basket_index")
     */
    public function index()
    {
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

        return $this->redirectToRoute('basket/index');

    }
    /**
    * @Route("/add/{id}", name="basket_add")
    */

    public function addToBasket(Course $course)
    {
        // default - new empty array
        $courses =[];

        // if 'products' array in session, retrieve and store in $products
        $session = new Session();
        if ($session->has('basket')){
            $courses = $session->get('basket');
        }
        // get ID of the course
        $id = $course->getId();
        // only try to add to array if not already in the array
        if (!array_key_exists($id,$courses)) {
            // append $product to our list
            $courses[$id] = $course;

            // store updated array back into the session
            $session->set('basket', $courses);
        }
        return $this->redirectToRoute('basket_index');
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
        // get ID of the course
        $id = $courses->getId();

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

            return $this->redirectToRoute('basket_index');
        }
    }

}
