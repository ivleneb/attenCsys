<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Currentattendance
 *
 * @ORM\Table(name="currentAttendance")
 * @ORM\Entity
 */
class Currentattendance
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="text", length=65535, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text", length=65535, nullable=false)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="currentEntry", type="datetime", nullable=false)
     */
    private $currententry;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="currentDepart", type="datetime", nullable=false)
     */
    private $currentdepart;

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
     * Set name
     *
     * @param string $name
     *
     * @return Currentattendance
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Set username
     *
     * @param string $username
     *
     * @return Currentattendance
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set currententry
     *
     * @param \DateTime $currententry
     *
     * @return Currentattendance
     */
    public function setCurrententry($currententry)
    {
        $this->currententry = $currententry;

        return $this;
    }

    /**
     * Get currententry
     *
     * @return \DateTime
     */
    public function getCurrententry()
    {
        return $this->currententry;
    }

    /**
     * Set currentdepart
     *
     * @param \DateTime $currentdepart
     *
     * @return Currentattendance
     */
    public function setCurrentdepart($currentdepart)
    {
        $this->currentdepart = $currentdepart;

        return $this;
    }

    /**
     * Get currentdepart
     *
     * @return \DateTime
     */
    public function getCurrentdepart()
    {
        return $this->currentdepart;
    }


    /**
     * Set email
     *
     * @param string $email
     *
     * @return Currentattendance
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
}
