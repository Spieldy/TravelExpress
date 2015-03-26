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
    * @ORM\ManyToMany(targetEntity="TE\PlatformBundle\Entity\User", cascade={"persist"})
    */
    private $users;

    /**
    * @ORM\ManyToOne(targetEntity="TE\PlatformBundle\Entity\Lift")
    * @ORM\JoinColumn(nullable=false)
    */
    private $lift;

    /**
     * @var integer
     *
     * @ORM\Column(name="seats", type="integer")
     */
    private $seats;

    public function __construct()
    {
      $this->users = new ArrayCollection();
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

    // Notez le singulier, on ajoute une seule catégorie à la fois
    public function addUser(User $user)
    {
      // Ici, on utilise l'ArrayCollection vraiment comme un tableau
      $this->users[] = $user;

      return $this;
    }

    public function removeUser(User $user)
    {
      // Ici on utilise une méthode de l'ArrayCollection, pour supprimer la catégorie en argument
      $this->users->removeElement($user);
    }

    // Notez le pluriel, on récupère une liste de catégories ici !
    public function getUsers()
    {
      return $this->users;
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

    /**
     * Set seats
     *
     * @param integer $seats
     * @return Booked
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
}
