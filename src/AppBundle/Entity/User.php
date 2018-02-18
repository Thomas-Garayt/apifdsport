<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\EntityBase;

/**
* @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
* @ORM\Table(name="user")
*/
class User extends EntityBase {

    /**
    * @ORM\OneToOne(targetEntity="Cookie", cascade={"persist"})
    * @ORM\JoinColumn(nullable=true)
    */
    private $cookie;

    /**
    * @ORM\Column(type="string")
    */
    private $firstname;

    /**
    * @ORM\Column(type="string", nullable=true)
    */
    private $lastname;

    /**
    * @ORM\OneToOne(targetEntity="Axe", cascade={"persist"})
    * @ORM\JoinColumn(nullable=true)
    */
    private $axe;

    /**
    * Get the value of Cookie
    *
    * @return mixed
    */
    public function getCookie() {
        return $this->cookie;
    }

    /**
    * Set the value of Cookie
    *
    * @param mixed cookie
    *
    * @return self
    */
    public function setCookie($cookie) {
        $this->cookie = $cookie;
        return $this;
    }

    /**
    * Get the value of Firstname
    *
    * @return mixed
    */
    public function getFirstname() {
        return $this->firstname;
    }

    /**
    * Set the value of Firstname
    *
    * @param mixed firstname
    *
    * @return self
    */
    public function setFirstname($firstname) {
        $this->firstname = $firstname;
        return $this;
    }

    /**
    * Get the value of Lastname
    *
    * @return mixed
    */
    public function getLastname() {
        return $this->lastname;
    }

    /**
    * Set the value of Lastname
    *
    * @param mixed lastname
    *
    * @return self
    */
    public function setLastname($lastname) {
        $this->lastname = $lastname;
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

}
