<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminController extends Controller
{
    /**
     * @Route("/login",name="login")
     */
    public function loginAction(Request $request)
    {
        $authUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('AdminBundle:Admin:login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }
    
   /**
    * @Route("/login_check",name="login_check")
    */
    public function checkAction(Request $request)
    {
        #
    }
    
    /**
    * @Route("/logout",name="logout")
    */
    public function logoutAction(Request $request)
    {
        #
    }
    
    /**
    * @Route("/index",name="index")
    */
    public function indexAction(Request $request)
    {
        return $this->render('AdminBundle:Admin:index.html.twig');
    }
}
