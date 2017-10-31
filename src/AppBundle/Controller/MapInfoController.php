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
        $location = "lat=" . $request->get('lat') . "&lan=" . $request->get('lan');
        $access_token = $request->get('access_token');
        $cars = $this->getDoctrine()->getRepository('AppBundle:Car')->findAll();

        if ($access_token == $this->getParameter('map_key') && !empty($cars)) {
            return new View([
                'cars:' => $cars
            ]);
        }
    }
}