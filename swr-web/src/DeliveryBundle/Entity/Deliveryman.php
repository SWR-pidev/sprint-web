<?php

namespace DeliveryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Mgilet\NotificationBundle\Annotation\Notifiable;
use Mgilet\NotificationBundle\NotifiableInterface;
/**
 *
 *
 *
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="DeliveryBundle\Repository\DeliverymenRepository")
 *  @ORM\Table(name="deliveryman")
 */


class Deliveryman
{
    /**
     * @ORM\Id
     * @var integer
     *
     * @ORM\Column(name="idDman", type="integer", nullable=false)
     *
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
     * @Assert\Regex(
     *     pattern     = "/^[a-z]+$/i",
     *     htmlPattern = "^[a-zA-Z]+$" , message="Please enter a valid number"
     * )
     * @ORM\Column(name="Lname", type="string", length=25, nullable=false)
     */
    private $lname;

    /**
     * @var integer
     *  @Assert\Regex("^[0-9]{8}$^", message="Please enter a valid number")
     * @Assert\NotBlank()
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
     * @return int
     */
    public function getIddman()
    {
        return $this->iddman;
    }

    /**
     * @param int $iddman
     */
    public function setIddman($iddman)
    {
        $this->iddman = $iddman;
    }

    /**
     * @return string
     */
    public function getFname()
    {
        return $this->fname;
    }

    /**
     * @param string $fname
     */
    public function setFname($fname)
    {
        $this->fname = $fname;
    }

    /**
     * @return string
     */
    public function getLname()
    {
        return $this->lname;
    }

    /**
     * @param string $lname
     */
    public function setLname($lname)
    {
        $this->lname = $lname;
    }

    /**
     * @return int
     */
    public function getPnum()
    {
        return $this->pnum;
    }

    /**
     * @param int $pnum
     */
    public function setPnum($pnum)
    {
        $this->pnum = $pnum;
    }

    /**
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return int
     */
    public function getNumd()
    {
        return $this->numd;
    }

    /**
     * @param int $numd
     */
    public function setNumd($numd)
    {
        $this->numd = $numd;
    }


}

