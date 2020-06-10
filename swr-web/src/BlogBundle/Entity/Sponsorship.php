<?php

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sponsorship
 *
 * @ORM\Table(name="sponsorship")
 * @ORM\Entity
 */
class Sponsorship
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idSp", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsp;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_sponsor", type="integer", nullable=false)
     */
    private $idSponsor;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_evt", type="integer", nullable=false)
     */
    private $idEvt;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=85, nullable=false)
     */
    private $logo;

    /**
     * @var float
     *
     * @ORM\Column(name="given_sponsor", type="float", precision=10, scale=0, nullable=false)
     */
    private $givenSponsor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_sponsor", type="date", nullable=false)
     */
    private $dateSponsor;



    /**
     * Get idsp
     *
     * @return integer
     */
    public function getIdsp()
    {
        return $this->idsp;
    }

    /**
     * Set idSponsor
     *
     * @param integer $idSponsor
     *
     * @return Sponsorship
     */
    public function setIdSponsor($idSponsor)
    {
        $this->idSponsor = $idSponsor;

        return $this;
    }

    /**
     * Get idSponsor
     *
     * @return integer
     */
    public function getIdSponsor()
    {
        return $this->idSponsor;
    }

    /**
     * Set idEvt
     *
     * @param integer $idEvt
     *
     * @return Sponsorship
     */
    public function setIdEvt($idEvt)
    {
        $this->idEvt = $idEvt;

        return $this;
    }

    /**
     * Get idEvt
     *
     * @return integer
     */
    public function getIdEvt()
    {
        return $this->idEvt;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return Sponsorship
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set givenSponsor
     *
     * @param float $givenSponsor
     *
     * @return Sponsorship
     */
    public function setGivenSponsor($givenSponsor)
    {
        $this->givenSponsor = $givenSponsor;

        return $this;
    }

    /**
     * Get givenSponsor
     *
     * @return float
     */
    public function getGivenSponsor()
    {
        return $this->givenSponsor;
    }

    /**
     * Set dateSponsor
     *
     * @param \DateTime $dateSponsor
     *
     * @return Sponsorship
     */
    public function setDateSponsor($dateSponsor)
    {
        $this->dateSponsor = $dateSponsor;

        return $this;
    }

    /**
     * Get dateSponsor
     *
     * @return \DateTime
     */
    public function getDateSponsor()
    {
        return $this->dateSponsor;
    }
}
