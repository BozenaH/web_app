<?php
/** test for Admin role */

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * verification for admin restrictions
 * Class AdminController
 * @package App\Controller
 */
class AdminController extends Controller
{
    /**
     * method to return twig template for this route
     * @Route("/admin", name="admin")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function index()
    {
        $template = 'admin/index.html.twig';
        $args = [];
        return $this->render($template, $args);

    }
}
