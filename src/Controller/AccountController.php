<?php


namespace App\Controller;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;



/**
 * @Route("/account", name="account_" )
 */
class AccountController extends AbstractController
{
    /**
     * @Route("/", name="account", methods="GET")
     * @param User $user
     * @return Response
     */
    public function index(UserRepository $userRepository): Response
    {
        if ($this->isGranted('ROLE_USER'))

        return $this->render('user/account.html.twig', $userRepository); $this->getUser();
    }


    /**
     * @Route("/{id}", name="account_edit")
     * @param User $user
     * @return Response
     */
    public function account_edit(User $user)
    {
        if($this->isGranted('ROLE_USER'))

        $user = $this->getUser();

        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findByUser($user);

        return $this->render('user/edit.html.twig.html.twig', ['user' => $user]);
    }


}