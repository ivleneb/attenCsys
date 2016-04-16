<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Regattendance
 *
 * @ORM\Table(name="regAttendance")
 * @ORM\Entity
 */
class Regattendance
{
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
     * @var string
     *
     * @ORM\Column(name="uid", type="text", length=65535, nullable=false)
     */
    private $uid;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="entry", type="datetime", nullable=false)
     */
    private $entry;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="depart", type="datetime", nullable=false)
     */
    private $depart;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Regattendance
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
     * Set uid
     *
     * @param string $uid
     *
     * @return Regattendance
     */
    public function setUid($uid)
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * Get uid
     *
     * @return string
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Set entry
     *
     * @param \DateTime $entry
     *
     * @return Regattendance
     */
    public function setEntry($entry)
    {
        $this->entry = $entry;

        return $this;
    }

    /**
     * Get entry
     *
     * @return \DateTime
     */
    public function getEntry()
    {
        return $this->entry;
    }

    /**
     * Set depart
     *
     * @param \DateTime $depart
     *
     * @return Regattendance
     */
    public function setDepart($depart)
    {
        $this->depart = $depart;

        return $this;
    }

    /**
     * Get depart
     *
     * @return \DateTime
     */
    public function getDepart()
    {
        return $this->depart;
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

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Regattendance
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
     * Set email
     *
     * @param string $email
     *
     * @return Regattendance
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
