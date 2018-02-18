<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\EntityBase;


/**
* @ORM\Entity(repositoryClass="AppBundle\Repository\CookieRepository")
* @ORM\Table(name="cookie")
*/
class Cookie extends EntityBase {

    /**
    * @ORM\Column(type="string", unique=true)
    */
    private $name;

    /**
    * @param mixed $name
    */
    public function setName($name) {
        $this->name = $name;
    }

    /**
    * @return mixed
    */
    public function getName() {
        return $this->name;
    }

    /**
    * @param mixed $cookieId
    */
    public function setCookieId($cookieId) {
        $this->cookie_id = $cookieId;
    }

    /**
    * @return mixed
    */
    public function getCookieId() {
        return $this->cookie_id;
    }


}
