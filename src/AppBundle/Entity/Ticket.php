<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\EntityBase;

/**
* @ORM\Entity(repositoryClass="AppBundle\Repository\TicketRepository")
* @ORM\Table(name="ticket")
*/
class Ticket extends EntityBase {

    /**
     * @ORM\Column(type="string")
     */
    private $category;

    /**
     * @ORM\Column(type="string")
     */
    private $price;

    /**
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Match")
     * @ORM\JoinColumn(nullable=false)
	 */
	private $match;

    /**
	 * @ORM\OneToOne(targetEntity="AppBundle\Entity\Axe")
     * @ORM\JoinColumn(nullable=true)
	 */
	private $axe;

    /**
     * Get the value of Category
     *
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of Category
     *
     * @param mixed category
     *
     * @return self
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get the value of Price
     *
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of Price
     *
     * @param mixed price
     *
     * @return self
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
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

    /**
     * Get the value of Axe
     *
     * @return mixed
     */
    public function getAxe()
    {
        return $this->axe;
    }

    /**
     * Set the value of Axe
     *
     * @param mixed axe
     *
     * @return self
     */
    public function setAxe($axe)
    {
        $this->axe = $axe;

        return $this;
    }

}
