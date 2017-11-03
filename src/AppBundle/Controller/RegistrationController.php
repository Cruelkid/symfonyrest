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
 * Class RegistrationController
 * @package AppBundle\Controller
 */
class RegistrationController extends FOSRestController
{
    /**
     * @Rest\Post("/register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @return View
     */
    public function registrationAction(Request $request, UserPasswordEncoderInterface $encoder) {
        $access_token = $request->get('access_token');
        if ($access_token != $this->getParameter('secret')) {
            return new View("Access denied.", Response::HTTP_UNAUTHORIZED);
        }
        $user = new User();
        $username = $request->get('username');
        $password = $request->get('password');
        $phone = $request->get('phone');
        $token = $user->generateToken();
        $email = $request->get('email');

        if (empty($username) || empty($email)) {
            return new View("EMPTY VALUES NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE);
        }

        $user->setUsername($username);
        $user->setPassword($encoder->encodePassword($user, $password));
        $user->setPhone($phone);
        $user->setToken($token);
        $user->setEmail($email);
        $user->setStatus("inactive");
        $user->setCountryId(1);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return new View([
            'user_id' => $user->getId(),
            'token' => $user->getToken()
        ], Response::HTTP_OK);
    }
}