<?php

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Donation
 *
 * @ORM\Table(name="donation")
 * @ORM\Entity
 */
class Donation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_don", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDon;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     */
    private $idUser;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_cmp", type="integer", nullable=true)
     */
    private $idCmp = 'NULL';

    /**
     * @var integer
     *
     * @ORM\Column(name="monthly", type="integer", nullable=true)
     */
    private $monthly = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=55, nullable=true)
     */
    private $message = 'NULL';

    /**
     * @var float
     *
     * @ORM\Column(name="funds", type="float", precision=10, scale=0, nullable=false)
     */
    private $funds;

    /**
     * @var integer
     *
     * @ORM\Column(name="given", type="integer", nullable=false)
     */
    private $given;

    /**
     * @var integer
     *
     * @ORM\Column(name="annonym", type="integer", nullable=false)
     */
    private $annonym;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dated", type="date", nullable=false)
     */
    private $dated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timed", type="time", nullable=false)
     */
    private $timed;



    /**
     * Get idDon
     *
     * @return integer
     */
    public function getIdDon()
    {
        return $this->idDon;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return Donation
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return integer
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set idCmp
     *
     * @param integer $idCmp
     *
     * @return Donation
     */
    public function setIdCmp($idCmp)
    {
        $this->idCmp = $idCmp;

        return $this;
    }

    /**
     * Get idCmp
     *
     * @return integer
     */
    public function getIdCmp()
    {
        return $this->idCmp;
    }

    /**
     * Set monthly
     *
     * @param integer $monthly
     *
     * @return Donation
     */
    public function setMonthly($monthly)
    {
        $this->monthly = $monthly;

        return $this;
    }

    /**
     * Get monthly
     *
     * @return integer
     */
    public function getMonthly()
    {
        return $this->monthly;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Donation
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set funds
     *
     * @param float $funds
     *
     * @return Donation
     */
    public function setFunds($funds)
    {
        $this->funds = $funds;

        return $this;
    }

    /**
     * Get funds
     *
     * @return float
     */
    public function getFunds()
    {
        return $this->funds;
    }

    /**
     * Set given
     *
     * @param integer $given
     *
     * @return Donation
     */
    public function setGiven($given)
    {
        $this->given = $given;

        return $this;
    }

    /**
     * Get given
     *
     * @return integer
     */
    public function getGiven()
    {
        return $this->given;
    }

    /**
     * Set annonym
     *
     * @param integer $annonym
     *
     * @return Donation
     */
    public function setAnnonym($annonym)
    {
        $this->annonym = $annonym;

        return $this;
    }

    /**
     * Get annonym
     *
     * @return integer
     */
    public function getAnnonym()
    {
        return $this->annonym;
    }

    /**
     * Set dated
     *
     * @param \DateTime $dated
     *
     * @return Donation
     */
    public function setDated($dated)
    {
        $this->dated = $dated;

        return $this;
    }

    /**
     * Get dated
     *
     * @return \DateTime
     */
    public function getDated()
    {
        return $this->dated;
    }

    /**
     * Set timed
     *
     * @param \DateTime $timed
     *
     * @return Donation
     */
    public function setTimed($timed)
    {
        $this->timed = $timed;

        return $this;
    }

    /**
     * Get timed
     *
     * @return \DateTime
     */
    public function getTimed()
    {
        return $this->timed;
    }
}
