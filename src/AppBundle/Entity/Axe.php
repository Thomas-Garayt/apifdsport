<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\EntityBase;

/**
* @ORM\Entity(repositoryClass="AppBundle\Repository\AxeRepository")
* @ORM\Table(name="axe")
*/
class Axe extends EntityBase {

    /**
    * @ORM\Column(type="boolean")
    */
    private $is_fixed = false;

    /**
    * @ORM\Column(type="float")
    */
    private $male = 0;

    /**
    * @ORM\Column(type="float")
    */
    private $female = 0;

    /**
    * @ORM\ManyToOne(targetEntity="Brand")
    * @ORM\JoinColumn(nullable=true)
    */
    private $brand;

    /**
    * @ORM\Column(type="string")
    */
    private $age = 0;

    /**
    * @ORM\Column(type="string")
    */
    private $csp = 0;

    /**
    * @ORM\Column(type="string")
    */
    private $sport = "";

    /**
    * @ORM\Column(type="string")
    */
    private $city = "";

    /**
    * @ORM\OneToOne(targetEntity="AppBundle\Entity\User")
    * @ORM\JoinColumn(nullable=true)
    */
    private $user;

    /**
    * @ORM\OneToOne(targetEntity="AppBundle\Entity\Product")
    * @ORM\JoinColumn(nullable=true)
    */
    private $product;

    /**
    * @ORM\OneToOne(targetEntity="AppBundle\Entity\Match")
    * @ORM\JoinColumn(nullable=true)
    */
    private $match;

    /**
    * @ORM\OneToOne(targetEntity="AppBundle\Entity\Ticket")
    * @ORM\JoinColumn(nullable=true)
    */
    private $ticket;

    /**
    * Get the value of Is Fixed
    *
    * @return mixed
    */
    public function getIsFixed() {
        return $this->is_fixed;
    }

    /**
    * Set the value of Is Fixed
    *
    * @param mixed is_fixed
    *
    * @return self
    */
    public function setIsFixed($is_fixed) {
        $this->is_fixed = $is_fixed;
        return $this;
    }

    /**
    * Get the value of Brand
    *
    * @return mixed
    */
    public function getBrand() {
        return $this->brand;
    }

    /**
    * Set the value of Brand
    *
    * @param mixed brand
    *
    * @return self
    */
    public function setBrand($brand) {
        $this->brand = $brand;
        return $this;
    }

    /**
    * Get the value of Age
    *
    * @return mixed
    */
    public function getAge() {
        return $this->age;
    }

    /**
    * Set the value of Age
    *
    * @param mixed age
    *
    * @return self
    */
    public function setAge($age) {
        $this->age = $age;
        return $this;
    }

    /**
    * Get the value of Csp
    *
    * @return mixed
    */
    public function getCsp() {
        return $this->csp;
    }

    /**
    * Set the value of Csp
    *
    * @param mixed csp
    *
    * @return self
    */
    public function setCsp($csp) {
        $this->csp = $csp;
        return $this;
    }

    /**
    * Get the value of Sport
    *
    * @return mixed
    */
    public function getSport() {
        return $this->sport;
    }

    /**
    * Set the value of Sport
    *
    * @param mixed sport
    *
    * @return self
    */
    public function setSport($sport) {
        $this->sport = $sport;
        return $this;
    }

    /**
    * Get the value of City
    *
    * @return mixed
    */
    public function getCity() {
        return $this->city;
    }

    /**
    * Set the value of City
    *
    * @param mixed city
    *
    * @return self
    */
    public function setCity($city) {
        $this->city = $city;
        return $this;
    }

    /**
    * Get the value of User
    *
    * @return mixed
    */
    public function getUser() {
        return $this->user;
    }

    /**
    * Set the value of User
    *
    * @param mixed user
    *
    * @return self
    */
    public function setUser($user) {
        $this->user = $user;
        return $this;
    }

    /**
    * Get the value of Product
    *
    * @return mixed
    */
    public function getProduct() {
        return $this->product;
    }

    /**
    * Set the value of Product
    *
    * @param mixed product
    *
    * @return self
    */
    public function setProduct($product) {
        $this->product = $product;
        return $this;
    }

    /**
    * Get the value of Match
    *
    * @return mixed
    */
    public function getMatch() {
        return $this->match;
    }

    /**
    * Set the value of Match
    *
    * @param mixed match
    *
    * @return self
    */
    public function setMatch($match) {
        $this->match = $match;
        return $this;
    }

    /**
    * Get the value of Ticket
    *
    * @return mixed
    */
    public function getTicket() {
        return $this->ticket;
    }

    /**
    * Set the value of Ticket
    *
    * @param mixed ticket
    *
    * @return self
    */
    public function setTicket($ticket) {
        $this->ticket = $ticket;
        return $this;
    }

    /**
    * Get the value of Male
    *
    * @return mixed
    */
    public function getMale() {
        return $this->male;
    }

    /**
    * Set the value of Male
    *
    * @param mixed male
    *
    * @return self
    */
    public function setMale($male) {
        $this->male = $male;
        return $this;
    }

    /**
    * Get the value of Female
    *
    * @return mixed
    */
    public function getFemale() {
        return $this->female;
    }

    /**
    * Set the value of Female
    *
    * @param mixed female
    *
    * @return self
    */
    public function setFemale($female) {
        $this->female = $female;
        return $this;
    }


}
