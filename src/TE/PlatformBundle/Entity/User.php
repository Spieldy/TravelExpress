<?php

namespace TE\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;



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

    /**
     * @var string
     *
     * @ORM\Column(name="cellphone", type="string", length=20, nullable=true)
     */
    protected $cellphone;


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

    public function setCellphone($cellphone)
    {
        $this->cellphone = $cellphone;

        return $this;
    }


    public function getCellphone()
    {
        return $this->cellphone;
    }

}
