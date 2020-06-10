<?php

namespace BlogBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use TuxOne\ValidationBundle\Validator\Constraints as TuxOneAssert;

use Doctrine\ORM\Mapping as ORM;



/**
 * Comments
 *
 * @ORM\Table(name="comments")
 * @ORM\Entity(repositoryClass="BlogBundle\Repository\BlogRepository")
 */
class Comments
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idC", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idc;

    /**
     * @var integer
     *
     * @ORM\Column(name="idP", type="integer", nullable=false)
     */
    private $idp;

    /**
     * @var string
     * @Assert\NotBlank
     * @TuxOneAssert\NotContainsBadWords()
     *
     * @ORM\Column(name="contenuC", type="string", length=400, nullable=false)
     */
    private $contenuc;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateC", type="datetime", nullable=false)
     */
    private $datec;

    /**
     * @var integer
     *
     * @ORM\Column(name="reportC", type="integer", nullable=false)
     */
    private $reportc;

    /**
     * @var integer
     *
     * @ORM\Column(name="iduser", type="integer", nullable=false)
     */
    public $iduser;



    /**
     * Get idc
     *
     * @return integer
     */
    public function getIdc()
    {
        return $this->idc;
    }

    /**
     * Set idp
     *
     * @param integer $idp
     *
     * @return Comments
     */
    public function setIdp($idp)
    {
        $this->idp = $idp;

        return $this;
    }

    /**
     * Get idp
     *
     * @return integer
     */
    public function getIdp()
    {
        return $this->idp;
    }

    /**
     * Set contenuc
     *
     * @param string $contenuc
     *
     * @return Comments
     */
    public function setContenuc($contenuc)
    {
        $this->contenuc = $contenuc;

        return $this;
    }

    /**
     * Get contenuc
     *
     * @return string
     */
    public function getContenuc()
    {
        return $this->contenuc;
    }

    /**
     * Set datec
     *
     * @param \DateTime $datec
     *
     * @return Comments
     */
    public function setDatec($datec)
    {
        $this->datec = $datec;

        return $this;
    }

    /**
     * Get datec
     *
     * @return \DateTime
     */
    public function getDatec()
    {
        return $this->datec;
    }

    /**
     * Set reportc
     *
     * @param integer $reportc
     *
     * @return Comments
     */
    public function setReportc($reportc)
    {
        $this->reportc = $reportc;

        return $this;
    }

    /**
     * Get reportc
     *
     * @return integer
     */
    public function getReportc()
    {
        return $this->reportc;
    }

    /**
     * Set iduser
     *
     * @param integer $iduser
     *
     * @return Comments
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;

        return $this;
    }

    /**
     * Get iduser
     *
     * @return integer
     */
    public function getIduser()
    {
        return $this->iduser;
    }
}
