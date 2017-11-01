<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Order
 *
 * @ORM\Table(name="`order`")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrderRepository")
 */
class Order
{
    public function __construct() {
        $this->route_points = new ArrayCollection();
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="user_location", type="string", length=255)
     */
    private $user_location;

    /**
     * @var int
     *
     * @ORM\Column(name="car_id", type="integer")
     */
    private $car_id;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;
    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=255)
     */
    private $region;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\RoutePoint", mappedBy="order_id")
     */
    private $route_points;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Driver")
     * @ORM\JoinColumn(name="driver_id", referencedColumnName="id")
     */
    private $driver_id;

    /**
     * @var string
     *
     * @ORM\Column(name="order_time", type="string", length=255)
     */
    private $order_time;

    /**
     * @var string
     * 
     * @ORM\Column(name="order_status", type="string", length=255)
     */
    private $order_status;

    /**
     * @return string
     */
    public function getOrderStatus()
    {
        return $this->order_status;
    }

    /**
     * @param string $order_status
     */
    public function setOrderStatus($order_status)
    {
        $this->order_status = $order_status;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUserLocation()
    {
        return $this->user_location;
    }

    /**
     * @param string $user_location
     */
    public function setUserLocation($user_location)
    {
        $this->user_location = $user_location;
    }

    /**
     * @return int
     */
    public function getCarId()
    {
        return $this->car_id;
    }

    /**
     * @param int $car_id
     */
    public function setCarId($car_id)
    {
        $this->car_id = $car_id;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param string $region
     */
    public function setRegion($region)
    {
        $this->region = $region;
    }

    /**
     * @return mixed
     */
    public function getRoutePoints()
    {
        return $this->route_points;
    }

    /**
     * @param mixed $route_point
     */
    public function setRoutePoints($route_point)
    {
//        foreach ($route_points as $route_point) {
            $this->route_points->add($route_point);
//        }
//        $this->route_points = $route_points;
    }

    /**
     * @return mixed
     */
    public function getDriverId()
    {
        return $this->driver_id;
    }

    /**
     * @param mixed $driver_id
     */
    public function setDriverId($driver_id)
    {
        $this->driver_id = $driver_id;
    }

    /**
     * @return string
     */
    public function getOrderTime()
    {
        return $this->order_time;
    }

    /**
     * @param string $order_time
     */
    public function setOrderTime($order_time)
    {
        $this->order_time = $order_time;
    }
}