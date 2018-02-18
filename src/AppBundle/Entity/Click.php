<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\EntityBase;

/**
* @ORM\Entity(repositoryClass="AppBundle\Repository\ClickRepository")
* @ORM\Table(name="click")
*/
class Click extends EntityBase {

	/**
	* @ORM\ManyToOne(targetEntity="User")
    * @ORM\JoinColumn(nullable=true)
	*/
	private $user;

	/**
	* @ORM\ManyToOne(targetEntity="Product")
    * @ORM\JoinColumn(nullable=true)
	*/
	private $product;

	/**
	* @ORM\ManyToOne(targetEntity="Match")
    * @ORM\JoinColumn(nullable=true)
	*/
	private $match;

	/**
	* @return mixed
	*/
	public function getUser() {
		return $this->user;
	}

	/**
	* @param mixed $user
	*/
	public function setUser($user) {
		$this->user = $user;
	}

	/**
	* @return mixed
	*/
	public function getProduct() {
		return $this->product;
	}

	/**
	* @param mixed $product
	*/
	public function setProduct($product) {
		$this->product = $product;
	}

	/**
	* @return mixed
	*/
	public function getClickId() {
		return $this->click_id;
	}

    /**
     * Get the value of Match
     *
     * @return mixed
     */
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * Set the value of Match
     *
     * @param mixed match
     *
     * @return self
     */
    public function setMatch($match)
    {
        $this->match = $match;

        return $this;
    }

}
