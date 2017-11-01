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
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class AuthorizationController
 * @package AppBundle\Controller
 */
class AuthorizationController extends FOSRestController
{
    /**
     * @Rest\Post("/auth")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @return View
     */
    public function authAction(Request $request, UserPasswordEncoderInterface $encoder) {
        $auth_key = $request->get('auth_key');
        $password = $request->get('password');
        $phone = $request->get('phone');
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->findOneBy([
            'phone' => $phone
        ]);

        if ($auth_key != $this->getParameter('secret')) {
            //TODO invalid token
        }

        if ($auth_key == $this->getParameter('secret')) {
            if ($encoder->isPasswordValid($user, $password)) {
                return new View([
                    'user_id' => $user->getId(),
                    'access_token' => $user->getToken(),
                    'user_status' => $user->getStatus()
                ], Response::HTTP_OK);
            } else {
                return new View("Invalid password. Access denied.", Response::HTTP_UNAUTHORIZED);
            }
        }

        return new View("User not found", Response::HTTP_NOT_FOUND);
    }
}