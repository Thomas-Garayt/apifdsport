<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\EntityBase;

/**
* @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
* @ORM\Table(name="product")
*/
class Product extends EntityBase {

    /**
    * @ORM\ManyToOne(targetEntity="ProductType")
    * @ORM\JoinColumn(nullable=true)
    */
    private $type;

    /**
    * @ORM\Column(type="text")
    */
    private $description;

    /**
    * @ORM\Column(type="boolean")
    */
    private $is_fixed;

    /**
    * @ORM\Column(type="float")
    */
    private $price;

    /**
    * @ORM\OneToOne(targetEntity="Axe")
    * @ORM\JoinColumn(nullable=true)
    */
    private $axe;

    /**
    * @ORM\Column(type="text")
    */
    private $img;

    /**
    * @ORM\Column(type="string")
    */
    private $name;


    /**
    * Get the value of Type
    *
    * @return mixed
    */
    public function getType() {
        return $this->type;
    }

    /**
    * Set the value of Type
    *
    * @param mixed type
    *
    * @return self
    */
    public function setType($type) {
        $this->type = $type;
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

}
