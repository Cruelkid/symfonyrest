<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Driver;
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

        if (!empty($user)) {
            if (!empty($cars)) {
                $result = [];
                foreach ($cars as $car) {
                    $driver_phone = $this->getDoctrine()->getRepository('AppBundle:Driver')->findOneBy([
                        'id' => $car->getDriverId()
                    ])->getPhone();
                    $location = [];
                    $location['lat'] = $this->getDoctrine()->getRepository('AppBundle:CarLocation')->findOneBy([
                        'carId' => $car->getId()
                    ])->getLat();
                    $location['lan'] = $this->getDoctrine()->getRepository('AppBundle:CarLocation')->findOneBy([
                        'carId' => $car->getId()
                    ])->getLan();

                    $result[] = [
                        'id' => $car->getId(),
                        'status' => $car->getStatus(),
                        'color' => $car->getColor(),
                        'direction' => $car->getDirection(),
                        'reg_number' => $car->getRegNumber(),
                        'year' => $car->getYear(),
                        'model' => $car->getModel(),
                        'currency' => $car->getCurrency(),
                        'planting_costs' => $car->getPlantingCosts(),
                        'driver_phone' => $driver_phone,
                        'costs_per_1' => $car->getCostsPer1(),
                        'car_photo' => $car->getCarPhoto(),
                        'location' => $location,
                    ];
                }

                return new View([
                    'cars:' => $result
                ], Response::HTTP_OK);
            }
        } else {
            return new View("Access denied.", Response::HTTP_UNAUTHORIZED);
        }
    }
}