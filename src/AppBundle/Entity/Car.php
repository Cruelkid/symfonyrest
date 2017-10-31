<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Car
 *
 * @ORM\Table(name="car")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CarRepository")
 */
class Car
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
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=255)
     */
    private $color;

    /**
     * @var string
     *
     * @ORM\Column(name="direction", type="string", length=255)
     */
    private $direction;

    /**
     * @var string
     *
     * @ORM\Column(name="reg_number", type="string", length=255, unique=true)
     */
    private $regNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="year", type="string", length=255)
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(name="brand", type="string", length=255)
     */
    private $brand;

    /**
     * @var string
     *
     * @ORM\Column(name="model", type="string", length=255)
     */
    private $model;

    /**
     * @var string
     *
     * @ORM\Column(name="currency", type="string", length=255)
     */
    private $currency;

    /**
     * @var string
     *
     * @ORM\Column(name="planting_costs", type="string", length=255)
     */
    private $plantingCosts;

    /**
     * @var string
     *
     * @ORM\Column(name="driver_phone", type="string", length=255)
     */
    private $driverPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="costs_per_1", type="string", length=255)
     */
    private $costsPer1;

    /**
     * @var string
     *
     * @ORM\Column(name="car_photo", type="string", length=255)
     */
    private $carPhoto;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255)
     */
    private $location;


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
     * Set status
     *
     * @param string $status
     *
     * @return Car
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set color
     *
     * @param string $color
     *
     * @return Car
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set direction
     *
     * @param string $direction
     *
     * @return Car
     */
    public function setDirection($direction)
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * Get direction
     *
     * @return string
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * Set regNumber
     *
     * @param string $regNumber
     *
     * @return Car
     */
    public function setRegNumber($regNumber)
    {
        $this->regNumber = $regNumber;

        return $this;
    }

    /**
     * Get regNumber
     *
     * @return string
     */
    public function getRegNumber()
    {
        return $this->regNumber;
    }

    /**
     * Set year
     *
     * @param string $year
     *
     * @return Car
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set brand
     *
     * @param string $brand
     *
     * @return Car
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set model
     *
     * @param string $model
     *
     * @return Car
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set currency
     *
     * @param string $currency
     *
     * @return Car
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set plantingCosts
     *
     * @param string $plantingCosts
     *
     * @return Car
     */
    public function setPlantingCosts($plantingCosts)
    {
        $this->plantingCosts = $plantingCosts;

        return $this;
    }

    /**
     * Get plantingCosts
     *
     * @return string
     */
    public function getPlantingCosts()
    {
        return $this->plantingCosts;
    }

    /**
     * Set driverPhone
     *
     * @param string $driverPhone
     *
     * @return Car
     */
    public function setDriverPhone($driverPhone)
    {
        $this->driverPhone = $driverPhone;

        return $this;
    }

    /**
     * Get driverPhone
     *
     * @return string
     */
    public function getDriverPhone()
    {
        return $this->driverPhone;
    }

    /**
     * Set costsPer1
     *
     * @param string $costsPer1
     *
     * @return Car
     */
    public function setCostsPer1($costsPer1)
    {
        $this->costsPer1 = $costsPer1;

        return $this;
    }

    /**
     * Get costsPer1
     *
     * @return string
     */
    public function getCostsPer1()
    {
        return $this->costsPer1;
    }

    /**
     * Set carPhoto
     *
     * @param string $carPhoto
     *
     * @return Car
     */
    public function setCarPhoto($carPhoto)
    {
        $this->carPhoto = $carPhoto;

        return $this;
    }

    /**
     * Get carPhoto
     *
     * @return string
     */
    public function getCarPhoto()
    {
        return $this->carPhoto;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return Car
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }
}

