<?php

namespace TE\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BookedPassenger
 *
 * @ORM\Table(name="booked_passenger")
 * @ORM\Entity(repositoryClass="TE\PlatformBundle\Entity\BookedPassengerRepository")
 */
class BookedPassenger
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
     * @var integer
     *
     * @ORM\Column(name="seats", type="integer")
     */
    private $seats;

    /**
     * @ORM\ManyToOne(targetEntity="TE\PlatformBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $passenger;

    /**
     * @ORM\ManyToOne(targetEntity="TE\PlatformBundle\Entity\Booked")
     * @ORM\JoinColumn(nullable=false)
     */
    private $booked;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set seats
     *
     * @param integer $seats
     * @return BookedPassenger
     */
    public function setSeats($seats)
    {
        $this->seats = $seats;

        return $this;
    }

    /**
     * Get seats
     *
     * @return integer
     */
    public function getSeats()
    {
        return $this->seats;
    }

    /**
     * Set passenger
     *
     * @param string $passenger
     * @return BookedPassenger
     */
    public function setPassenger(User $passenger)
    {
        $this->passenger = $passenger;

        return $this;
    }

    /**
     * Get passenger
     *
     */
    public function getPassenger()
    {
        return $this->passenger;
    }

    /**
     * Set booked
     *
     */
    public function setBooked(Booked $booked)
    {
        $this->booked = $booked;

        return $this;
    }

    /**
     * Get booked
     *
     * @return string
     */
    public function getBooked()
    {
        return $this->booked;
    }
}
