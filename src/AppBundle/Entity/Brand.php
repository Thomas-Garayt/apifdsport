<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\EntityBase;

/**
* @ORM\Entity(repositoryClass="AppBundle\Repository\BrandRepository")
 * @ORM\Table(name="brand")
 */
class Brand extends EntityBase {

    /**
    * @ORM\Column(type="string")
    */
    private $name;

    /**
    * @ORM\Column(type="string")
    */
    private $description;

    /**
    * Get the value of Name
    *
    * @return mixed
    */
    public function getName() {
        return $this->name;
    }

    /**
    * Set the value of Name
    *
    * @param mixed name
    *
    * @return self
    */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
    * Get the value of Description
    *
    * @return mixed
    */
    public function getDescription() {
        return $this->description;
    }

    /**
    * Set the value of Description
    *
    * @param mixed description
    *
    * @return self
    */
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

}
