<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\EntityBase;

/**
* @ORM\Entity(repositoryClass="AppBundle\Repository\MatchRepository")
* @ORM\Table(name="`match`")
*/
class Match extends EntityBase {

    /**
    * @ORM\Column(type="string")
    */
    private $home;

    /**
    * @ORM\Column(type="string")
    */
    private $visitor;

    /**
    * @ORM\Column(type="string")
    */
    private $address;

    /**
    * @ORM\Column(type="string")
    */
    private $sport;

    /**
    * @ORM\Column(type="datetime")
    */
    private $date;

    /**
    * @ORM\Column(type="string")
    */
    private $hour;

    /**
    * @ORM\OneToOne(targetEntity="AppBundle\Entity\Axe")
    * @ORM\JoinColumn(nullable=true)
    */
	private $axe;

    /**
    * @ORM\Column(type="string")
    */
    private $img;

    /**
    * @ORM\OneToMany(targetEntity="AppBundle\Entity\Ticket", mappedBy="match")
    * @ORM\JoinColumn(nullable=true)
    */
    private $tickets;

    /**
     * @ORM\Column(type="string")
     */
    private $price;

    /**
    * Get the value of Home
    *
    * @return mixed
    */
    public function getHome() {
        return $this->home;
    }

    /**
    * Set the value of Home
    *
    * @param mixed home
    *
    * @return self
    */
    public function setHome($home) {
        $this->home = $home;
        return $this;
    }

    /**
    * Get the value of Visitor
    *
    * @return mixed
    */
    public function getVisitor() {
        return $this->visitor;
    }

    /**
    * Set the value of Visitor
    *
    * @param mixed visitor
    *
    * @return self
    */
    public function setVisitor($visitor) {
        $this->visitor = $visitor;
        return $this;
    }

    /**
    * Get the value of Address
    *
    * @return mixed
    */
    public function getAddress() {
        return $this->address;
    }

    /**
    * Set the value of Address
    *
    * @param mixed address
    *
    * @return self
    */
    public function setAddress($address) {
        $this->address = $address;
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
    * Get the value of Axe
    *
    * @return mixed
    */
    public function getAxe() {
        return $this->axe;
    }

    /**
    * Set the value of Axe
    *
    * @param mixed axe
    *
    * @return self
    */
    public function setAxe($axe) {
        $this->axe = $axe;
        return $this;
    }

    /**
    * Get the value of Date
    *
    * @return mixed
    */
    public function getDate() {
        return $this->date;
    }

    /**
    * Set the value of Date
    *
    * @param mixed date
    *
    * @return self
    */
    public function setDate($date) {
        $this->date = $date;
        return $this;
    }

    /**
    * Get the value of Img
    *
    * @return mixed
    */
    public function getImg() {
        return $this->img;
    }

    /**
    * Set the value of Img
    *
    * @param mixed img
    *
    * @return self
    */
    public function setImg($img) {
        $this->img = $img;
        return $this;
    }

    /**
    * Get the value of Tickets
    *
    * @return mixed
    */
    public function getTickets() {
        return $this->tickets;
    }

    /**
    * Set the value of Tickets
    *
    * @param mixed tickets
    *
    * @return self
    */
    public function setTickets($tickets) {
        $this->tickets = $tickets;
        return $this;
    }


    /**
    * Get the value of Hour
    *
    * @return mixed
    */
    public function getHour() {
        return $this->hour;
    }

    /**
    * Set the value of Hour
    *
    * @param mixed hour
    *
    * @return self
    */
    public function setHour($hour) {
        $this->hour = $hour;
        return $this;
    }


    /**
    * Get the value of Price
    *
    * @return mixed
    */
    public function getPrice() {
        return $this->price;
    }

    /**
    * Set the value of Price
    *
    * @param mixed price
    *
    * @return self
    */
    public function setPrice($price) {
        $this->price = $price;
        return $this;
    }

}
