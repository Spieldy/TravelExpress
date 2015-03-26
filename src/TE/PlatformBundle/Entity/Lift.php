<?php

namespace TE\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use TE\PlatformBundle\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;


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
    private $driver;

    /**
     * @var string
     *
     * @ORM\Column(name="fromCity", type="string", length=255)
     * @Assert\Length(min=3)
     */
    private $fromCity;

    /**
     * @var string
     *
     * @ORM\Column(name="toCity", type="string", length=255)
     * @Assert\Length(min=3)
     */
    private $toCity;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateLift", type="datetime")
     * @Assert\DateTime()
     */
    private $dateLift;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal")
     * @Assert\Range(
     *      min = 0,
     *      max = 500,
     *      minMessage = "Vous devez saisir une valeur positive",
     *      maxMessage = "Vous ne devez pas dépasser 500 pour le tarif"
     * )
     */
    private $price;

    /**
     * @var integer
     *
     * @ORM\Column(name="seats", type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 6,
     *      minMessage = "Vous devez saisir une valeur positive",
     *      maxMessage = "Vous ne devez pas dépasser 6 places"
     * )
     */
    private $seats;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isAvailable", type="boolean")
     */
    private $isAvailable = true;


    public function __construct()
    {
      $this->dateLift = new \DateTime();
    }
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function setDriver(User $user)
    {
      $this->driver = $user;

      return $this;
    }

    public function getDriver()
    {
      return $this->driver;
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
