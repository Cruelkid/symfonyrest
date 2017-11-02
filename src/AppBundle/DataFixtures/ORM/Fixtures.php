<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Car;
use AppBundle\Entity\CarLocation;
use AppBundle\Entity\Country;
use AppBundle\Entity\Driver;
use AppBundle\Entity\Region;
use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Fixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user2 = new User();
        $driver1 = new Driver();
        $driver2 = new Driver();
        $car1 = new Car();
        $car2 = new Car();
        $car_location1 = new CarLocation();
        $car_location2 = new CarLocation();
        $country = new Country();
        $region = new Region();

        $user1->setUsername("user1");
        $user1->setPassword(md5("user1"));
        $user1->setCountryId(1);
        $user1->setStatus("inactive");
        $user1->setPhone("111-11-11");
        $user1->setEmail("user1@user.com");
        $user1->setToken('(a#o\"HSwZI*c\9}w');

        $user2->setUsername("user2");
        $user2->setPassword(md5("user2"));
        $user2->setCountryId(1);
        $user2->setStatus("inactive");
        $user2->setPhone("222-22-22");
        $user2->setEmail("user2@user.com");
        $user2->setToken('*\>isU~B|;6hc$*o');

        $driver1->setUsername("driver1");
        $driver1->setPassword(md5("driver1"));
        $driver1->setCarId(1);
        $driver1->setPhone("333-33-33");
        $driver1->setEmail("driver1@driver.com");
        $driver1->setToken('TK\{3j}~|u>.)|&A');

        $driver2->setUsername("driver2");
        $driver2->setPassword(md5("driver2"));
        $driver2->setCarId(2);
        $driver2->setPhone("444-44-44");
        $driver2->setEmail("driver2@driver.com");
        $driver2->setToken('odplaqef`#IE(y=^');

        $car1->setDriverId(1);
        $car1->setStatus("1");
        $car1->setColor("red");
        $car1->setDirection("300");
        $car1->setRegNumber("AA2345");
        $car1->setYear("2014");
        $car1->setBrand("Audi");
        $car1->setModel("A4");
        $car1->setCurrency("frn");
        $car1->setPlantingCosts("32");
        $car1->setCostsPer1("2");
        $car1->setCarPhoto("http://example.com/data/cars/mercedes-ml.png");
        $car1->setLocationId("1");

        $car2->setDriverId(2);
        $car2->setStatus("1");
        $car2->setColor("black");
        $car2->setDirection("300");
        $car2->setRegNumber("AA1234");
        $car2->setYear("2014");
        $car2->setBrand("Mercedes");
        $car2->setModel("CLK");
        $car2->setCurrency("frn");
        $car2->setPlantingCosts("32");
        $car2->setCostsPer1("2");
        $car2->setCarPhoto("http://example.com/data/cars/mercedes-ml.png");
        $car2->setLocationId("2");

        $car_location1->setCarId(1);
        $car_location1->setLat("23.345");
        $car_location1->setLan("43.321");

        $car_location2->setCarId(2);
        $car_location2->setLat("12.765");
        $car_location2->setLan("32.432");

        $country->setName("Ukraine");

        $region->setName("Dnipro");

        $manager->persist($user1);
        $manager->persist($user2);
        $manager->persist($driver1);
        $manager->persist($driver2);
        $manager->persist($car1);
        $manager->persist($car2);
        $manager->persist($car_location1);
        $manager->persist($car_location2);
        $manager->persist($country);
        $manager->persist($region);
        $manager->flush();
    }
}