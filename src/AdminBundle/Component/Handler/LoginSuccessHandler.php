<?php

namespace AdminBundle\Component\Handler;

use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationSuccessHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\HttpUtils;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class LoginSuccessHandler extends DefaultAuthenticationSuccessHandler
{
    private $router;

    public function __construct(HttpUtils $httpUtils, array $options, Router $router)
    {
        $options = array_merge($options, array('default_target_path' => 'list_teams'));
        parent::__construct($httpUtils, $options);
        $this->router = $router;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $json = array(
            'has_error' => false,
            'username' => $token->getUser()->getUsername(),
            'target_path' => $this->router->generate('list_teams')
        );
        return new JsonResponse($json);
    }
}
