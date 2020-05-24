<?php

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Deliveryman
 *
 * @ORM\Table(name="deliveryman")
 * @ORM\Entity
 */
class Deliveryman
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idDman", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddman;

    /**
     * @var string
     *
     * @ORM\Column(name="Fname", type="string", length=25, nullable=false)
     */
    private $fname;

    /**
     * @var string
     *
     * @ORM\Column(name="Lname", type="string", length=25, nullable=false)
     */
    private $lname;

    /**
     * @var integer
     *
     * @ORM\Column(name="Pnum", type="integer", nullable=false)
     */
    private $pnum;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=55, nullable=false)
     */
    private $mail;

    /**
     * @var integer
     *
     * @ORM\Column(name="numD", type="integer", nullable=false)
     */
    private $numd = '0';



    /**
     * Get iddman
     *
     * @return integer
     */
    public function getIddman()
    {
        return $this->iddman;
    }

    /**
     * Set fname
     *
     * @param string $fname
     *
     * @return Deliveryman
     */
    public function setFname($fname)
    {
        $this->fname = $fname;

        return $this;
    }

    /**
     * Get fname
     *
     * @return string
     */
    public function getFname()
    {
        return $this->fname;
    }

    /**
     * Set lname
     *
     * @param string $lname
     *
     * @return Deliveryman
     */
    public function setLname($lname)
    {
        $this->lname = $lname;

        return $this;
    }

    /**
     * Get lname
     *
     * @return string
     */
    public function getLname()
    {
        return $this->lname;
    }

    /**
     * Set pnum
     *
     * @param integer $pnum
     *
     * @return Deliveryman
     */
    public function setPnum($pnum)
    {
        $this->pnum = $pnum;

        return $this;
    }

    /**
     * Get pnum
     *
     * @return integer
     */
    public function getPnum()
    {
        return $this->pnum;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return Deliveryman
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set numd
     *
     * @param integer $numd
     *
     * @return Deliveryman
     */
    public function setNumd($numd)
    {
        $this->numd = $numd;

        return $this;
    }

    /**
     * Get numd
     *
     * @return integer
     */
    public function getNumd()
    {
        return $this->numd;
    }
}
