<?php

namespace TE\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use TE\PlatformBundle\Entity\User;


/**
 * Lift
 *
 * @ORM\Table(name="lift")
 * @ORM\Entity(repositoryClass="TE\PlatformBundle\Entity\LiftRepository")
 */
class Lift
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="TE\PlatformBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="fromCity", type="string", length=255)
     */
    private $fromCity;

    /**
     * @var string
     *
     * @ORM\Column(name="toCity", type="string", length=255)
     */
    private $toCity;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateLift", type="datetime")
     */
    private $dateLift;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal")
     */
    private $price;

    /**
     * @var integer
     *
     * @ORM\Column(name="seats", type="integer")
     */
    private $seats;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isAvailable", type="boolean")
     */
    private $isAvailable = true;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function setUser(User $user)
    {
      $this->user = $user;

      return $this;
    }

    public function getUser()
    {
      return $this->user;
    }

    /**
     * Set fromCity
     *
     * @param string $fromCity
     * @return Lift
     */
    public function setFromCity($fromCity)
    {
        $this->fromCity = $fromCity;

        return $this;
    }

    /**
     * Get fromCity
     *
     * @return string
     */
    public function getFromCity()
    {
        return $this->fromCity;
    }

    /**
     * Set toCity
     *
     * @param string $toCity
     * @return Lift
     */
    public function setToCity($toCity)
    {
        $this->toCity = $toCity;

        return $this;
    }

    /**
     * Get toCity
     *
     * @return string
     */
    public function getToCity()
    {
        return $this->toCity;
    }

    /**
     * Set dateLift
     *
     * @param \DateTime $dateLift
     * @return Lift
     */
    public function setDateLift($dateLift)
    {
        $this->dateLift = $dateLift;

        return $this;
    }

    /**
     * Get dateLift
     *
     * @return \DateTime
     */
    public function getDateLift()
    {
        return $this->dateLift;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return Lift
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set isAvailable
     *
     * @param boolean $isAvailable
     * @return Lift
     */
    public function setIsAvailable($isAvailable)
    {
        $this->isAvailable = $isAvailable;

        return $this;
    }


    public function getIsAvailable()
    {
        return $this->isAvailable;
    }

    public function setSeats($seats)
    {
        $this->seats = $seats;

        return $this;
    }

    public function getseats()
    {
        return $this->seats;
    }
}
