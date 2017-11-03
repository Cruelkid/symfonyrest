<?php

namespace AppBundle\Controller;

use AppBundle\Entity\RoutePoint;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Order;

/**
 * Class OrderController
 * @package AppBundle\Controller
 */
class OrderController extends FOSRestController
{
    /**
     * @Rest\Post("/addOrder")
     * @param Request $request
     * @return View
     */
    public function addOrder(Request $request) {
        $auth_key = $request->get('auth_key');
        
        if ($auth_key == $this->getParameter('secret')) {
            $driver = $this->getDoctrine()->getRepository('AppBundle:Driver')->findOneBy([
                'id' => $request->request->get('driver_id')
            ]);
            $user_location = implode(", ", $request->request->get('user_location'));
            $car_id = $request->request->get('car_id');
            $country = $this->getDoctrine()->getRepository('AppBundle:Country')->findOneBy([
                'id' => $request->request->get('country_id')
            ])->getName();
            $region = $this->getDoctrine()->getRepository('AppBundle:Region')->findOneBy([
                'id' => $request->request->get('region_id')
            ])->getName();
            $order_time = date("Y-m-d H:i:s");
            $route_points = $request->request->get('route_points');

            $order = new Order();

            $order->setDriverId($driver);
            $order->setUserLocation($user_location);
            $order->setCarId($car_id);
            $order->setCountry($country);
            $order->setRegion($region);
            $order->setOrderTime($order_time);
            $order->setOrderStatus("Awaits driver's response.");

            $em = $this->getDoctrine()->getManager();
            $em->persist($order);
            $em->flush();

            /**add push message here **/

            foreach ($route_points as $route_point) {
                $routePoint = new RoutePoint();
                $routePoint->setOrderId($order);
                $routePoint->setAddress($route_point['address']);
                $routePoint->setLat($route_point['lat']);
                $routePoint->setLan($route_point['lan']);
                $routePoint->setSort($route_point['sort']);
                $em->persist($routePoint);
            }
            $em->flush();

            return new View([
                'order_id' => $order->getId(),
                'order_status' => $order->getOrderStatus()
            ], Response::HTTP_OK);
        } else {
            return new View("Access denied.", Response::HTTP_UNAUTHORIZED);
        }
    }
}