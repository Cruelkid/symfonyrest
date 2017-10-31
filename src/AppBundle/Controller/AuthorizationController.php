<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\User;

/**
 * Class AuthorizationController
 * @package AppBundle\Controller
 */
class AuthorizationController extends FOSRestController
{
    /**
     * @Rest\Post("/auth")
     * @param Request $request
     * @return View
     */
    public function authAction(Request $request) {
        $auth_key = $request->get('auth_key');
        $password = md5($request->get('password'));
        $phone = $request->get('phone');
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->findOneBy([
            'password' => $password,
            'phone' => $phone
        ]);

        if ($auth_key != $this->getParameter('auth_key')) {
            //TODO invalid token
        }

        if ($auth_key == $this->getParameter('auth_key') && !empty($user)) {
            return new View([
                'user_id' => $user->getId(),
                'access_token' => $user->getToken(),
                'user_status' => $user->getStatus()
            ], Response::HTTP_OK);
        }

        return new View("User not found", Response::HTTP_NOT_FOUND);
    }
}