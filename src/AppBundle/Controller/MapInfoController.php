<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Car;
use AppBundle\Entity\User;

/**
 * Class MapInfoController
 * @package AppBundle\Controller
 */
class MapInfoController extends FOSRestController
{
    /**
     * @Rest\Post("/getMapInfo")
     * @param Request $request
     * @return View
     */
    public function getMapInfoAction(Request $request) {
        $token = $request->get('access_token');
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->findOneBy([
           'token' => $token
        ]);
        $cars = $this->getDoctrine()->getRepository('AppBundle:Car')->findAll();
        $location = "lat=" . $request->get('lat') . "&lan=" . $request->get('lan');

        if (!empty($user)) {
            if (!empty($cars)) {
                return new View([
                    'cars:' => $cars
                ]);
            }
        } else {
            return new View("Access denied.", Response::HTTP_UNAUTHORIZED);
        }
    }
}