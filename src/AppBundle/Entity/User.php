<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

     /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255,nullable=true)
     */
    private $firstName;

     /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255,nullable=true)
     */
    private $lastName;

     /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=255,nullable=true)
     */
    private $tel;

     /**
     * @var string
     *
     * @ORM\Column(name="grade", type="string", length=255,nullable=true)
     */
    private $grade;

     /**
     * @var string
     *
     * @ORM\Column(name="civil_status", type="string", length=255,nullable=true)
     */
    private $civilStatus;

     /**
     * @var string
     *
     * @ORM\Column(name="adress", type="string", length=255,nullable=true)
     */
    private $adress;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_children", type="integer",nullable=true)
     */
    private $nbChildren;

    /** 
    * @ORM\Column(name="date_of_birth",type="datetime",nullable=true)
    */
    private $dateOfBirth;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Prime",mappedBy="user")
     */
    private $primes;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Credit",mappedBy="user")
     */
    private $credits;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set tel
     *
     * @param string $tel
     *
     * @return User
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set grade
     *
     * @param string $grade
     *
     * @return User
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * Get grade
     *
     * @return string
     */
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * Set civilStatus
     *
     * @param string $civilStatus
     *
     * @return User
     */
    public function setCivilStatus($civilStatus)
    {
        $this->civilStatus = $civilStatus;

        return $this;
    }

    /**
     * Get civilStatus
     *
     * @return string
     */
    public function getCivilStatus()
    {
        return $this->civilStatus;
    }

    /**
     * Set adress
     *
     * @param string $adress
     *
     * @return User
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * Get adress
     *
     * @return string
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set nbChildren
     *
     * @param integer $nbChildren
     *
     * @return User
     */
    public function setNbChildren($nbChildren)
    {
        $this->nbChildren = $nbChildren;

        return $this;
    }

    /**
     * Get nbChildren
     *
     * @return integer
     */
    public function getNbChildren()
    {
        return $this->nbChildren;
    }

    /**
     * Set dateOfBirth
     *
     * @param \DateTime $dateOfBirth
     *
     * @return User
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * Get dateOfBirth
     *
     * @return \DateTime
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * Add prime
     *
     * @param \AppBundle\Entity\Prime $prime
     *
     * @return User
     */
    public function addPrime(\AppBundle\Entity\Prime $prime)
    {
        $this->primes[] = $prime;

        return $this;
    }

    /**
     * Remove prime
     *
     * @param \AppBundle\Entity\Prime $prime
     */
    public function removePrime(\AppBundle\Entity\Prime $prime)
    {
        $this->primes->removeElement($prime);
    }

    /**
     * Get primes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPrimes()
    {
        return $this->primes;
    }

    /**
     * Add credit
     *
     * @param \AppBundle\Entity\Credit $credit
     *
     * @return User
     */
    public function addCredit(\AppBundle\Entity\Credit $credit)
    {
        $this->credits[] = $credit;

        return $this;
    }

    /**
     * Remove credit
     *
     * @param \AppBundle\Entity\Credit $credit
     */
    public function removeCredit(\AppBundle\Entity\Credit $credit)
    {
        $this->credits->removeElement($credit);
    }

    /**
     * Get credits
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCredits()
    {
        return $this->credits;
    }
}
