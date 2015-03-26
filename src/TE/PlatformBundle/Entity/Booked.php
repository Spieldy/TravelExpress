<?php

namespace TE\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use TE\UserBundle\Entity\User;


/**
 * Booked
 *
 * @ORM\Table(name="booked")
 * @ORM\Entity(repositoryClass="TE\PlatformBundle\Entity\BookedRepository")
 */
class Booked
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
     * @ORM\ManyToOne(targetEntity="TE\PlatformBundle\Entity\Lift")
     * @ORM\JoinColumn(nullable=false)
     */
    private $lift;


    public function __construct()
    {
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

    public function setLift(Lift $lift)
    {
      $this->lift = $lift;

      return $this;
    }

    public function getLift()
    {
      return $this->lift;
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

}
