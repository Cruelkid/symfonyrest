<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Order;

/**
 * Class OrderStatusController
 * @package AppBundle\Controller
 */
class OrderStatusController extends FOSRestController
{
    /**
     * @Rest\Put("/setOrderStatus")
     * @param Request $request
     * @return View
     */
    public function setOrderStatusAction (Request $request) {
        $access_token = $request->request->get('access_token');
        $order_id = $request->request->get('order_id');
        $order_status = $request->request->get('order_status');
        if (empty($order_status)) { return new View("Order status cannot be empty.", Response::HTTP_NOT_ACCEPTABLE); }

        $user = $this->getDoctrine()->getRepository('AppBundle:User')->findOneBy([
            'token' => $access_token
        ]);
        $driver = $this->getDoctrine()->getRepository('AppBundle:Driver')->findOneBy([
            'token' => $access_token
        ]);
        $order = $this->getDoctrine()->getRepository('AppBundle:Order')->findOneBy([
            'id' => $order_id,
        ]);

        if (empty($order)) { return new View("Order not found!", Response::HTTP_NOT_FOUND); }

        $current_status = (int)$order->getOrderStatus();

        if (!empty($user)) {
            if ($current_status == 6) {
                return new View("Order already cancelled.", Response::HTTP_OK);
            }
            if ($order_status == 6) {
                if ($order_status > 0 && $current_status <= 3) {
                    $this->setStatus($order, $order_status);
                    return new View("Order cancelled.", Response::HTTP_OK);
                }
            } else {
                return new View("Not allowed action.", Response::HTTP_NOT_ACCEPTABLE);
            }
        } elseif (!empty($user) && $access_token != $user->getToken()) {
            return new View("Invalid access token!", Response::HTTP_UNAUTHORIZED);
        }

        if (!empty($driver)) {
            if ($order_status > 0 && $order_status < 6) {
                if ($current_status == 0) {
                    if (!($order_status == 1 || $order_status == 5)) {
                        return new View("You can set only '1' or '5' status!", Response::HTTP_NOT_ACCEPTABLE);
                    }
                }
                if ($current_status == 1 && $order_status != 2) {
                    return new View("You can set only '2' status!", Response::HTTP_NOT_ACCEPTABLE);
                }
                if ($current_status == 2 && $order_status != 3) {
                    return new View("You can set only '3' status!", Response::HTTP_NOT_ACCEPTABLE);
                }
                if ($current_status == 3 && $order_status != 4) {
                    return new View("You can set only '4' status!", Response::HTTP_NOT_ACCEPTABLE);
                }

                $this->setStatus($order, $order_status);
                return new View([
                    "Success" => $order_status
                ], Response::HTTP_OK);

            } elseif (!($order_status > 0 && $order_status < 6)) {
                return new View("Invalid status!", Response::HTTP_NOT_ACCEPTABLE);
            }
        } elseif (!empty($driver) && $access_token != $driver->getToken()) {
            return new View("Invalid access token!", Response::HTTP_UNAUTHORIZED);
        }
    }

    private function setStatus(Order $order, $order_status) {
        $order->setOrderStatus($order_status);
        $em = $this->getDoctrine()->getManager();
        $em->persist($order);
        $em->flush();
    }
}