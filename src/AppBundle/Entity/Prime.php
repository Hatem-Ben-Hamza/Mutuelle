<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Prime
 *
 * @ORM\Table(name="prime")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PrimeRepository")
 */
class Prime
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="demande", type="text")
     */
    private $demande;

    /**
     * @var string
     *
     * @ORM\Column(name="signature", type="text")
     */
    private $signature;

    /**
     * @var int
     *
     * @ORM\Column(name="satisfaction", type="integer")
     */
    private $satisfaction;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /** 
    * @ORM\Column(name="date",type="datetime",nullable=true)
    */
    private $datedemande;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User",inversedBy="primes")
     * @ORM\JoinColumn(name="user",referencedColumnName="id")
     */
    private $user;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Prime
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set demande
     *
     * @param string $demande
     *
     * @return Prime
     */
    public function setDemande($demande)
    {
        $this->demande = $demande;

        return $this;
    }

    /**
     * Get demande
     *
     * @return string
     */
    public function getDemande()
    {
        return $this->demande;
    }

    /**
     * Set signature
     *
     * @param string $signature
     *
     * @return Prime
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;

        return $this;
    }

    /**
     * Get signature
     *
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * Set satisfaction
     *
     * @param integer $satisfaction
     *
     * @return Prime
     */
    public function setSatisfaction($satisfaction)
    {
        $this->satisfaction = $satisfaction;

        return $this;
    }

    /**
     * Get satisfaction
     *
     * @return int
     */
    public function getSatisfaction()
    {
        return $this->satisfaction;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Prime
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Prime
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set datedemande
     *
     * @param \DateTime $datedemande
     *
     * @return Prime
     */
    public function setDatedemande($datedemande)
    {
        $this->datedemande = $datedemande;

        return $this;
    }

    /**
     * Get datedemande
     *
     * @return \DateTime
     */
    public function getDatedemande()
    {
        return $this->datedemande;
    }
}
