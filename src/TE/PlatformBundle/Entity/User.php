<?php

namespace TE\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;


/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="TE\PlatformBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="positive", type="integer")
     */
    protected $positive = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="negative", type="integer")
     */
    protected $negative = 0;


    public function setPositive($positive)
    {
        $this->positive = $positive;

        return $this;
    }

    public function getPositive()
    {
        return $this->positive;
    }

    public function setNegative($negative)
    {
        $this->negative = $negative;

        return $this;
    }

    public function getNegative()
    {
        return $this->negative;
    }

}
