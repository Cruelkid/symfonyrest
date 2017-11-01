<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CarLocation
 *
 * @ORM\Table(name="car_location")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CarLocationRepository")
 */
class CarLocation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="car_id", type="integer", unique=true)
     */
    private $carId;

    /**
     * @var string
     *
     * @ORM\Column(name="lat", type="string", length=255)
     */
    private $lat;

    /**
     * @var string
     *
     * @ORM\Column(name="lan", type="string", length=255)
     */
    private $lan;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set carId
     *
     * @param integer $carId
     *
     * @return CarLocation
     */
    public function setCarId($carId)
    {
        $this->carId = $carId;

        return $this;
    }

    /**
     * Get carId
     *
     * @return int
     */
    public function getCarId()
    {
        return $this->carId;
    }

    /**
     * Set lat
     *
     * @param string $lat
     *
     * @return CarLocation
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat
     *
     * @return string
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lan
     *
     * @param string $lan
     *
     * @return CarLocation
     */
    public function setLan($lan)
    {
        $this->lan = $lan;

        return $this;
    }

    /**
     * Get lan
     *
     * @return string
     */
    public function getLan()
    {
        return $this->lan;
    }
}

