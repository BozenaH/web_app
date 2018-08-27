<?php
/**
 * This is to manage default route to homepage
 */
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * this class contains method to ensure user is directed to homepage as default
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController extends Controller
{
    /**
     * test method to return twig template for this route
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $template = 'default/homepage.html.twig';
        $args = [];
        return $this->render($template, $args);
    }

}
