<?php

namespace HousingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ratings
 *
 * @ORM\Table(name="ratings", indexes={@ORM\Index(name="fk_hr", columns={"idh"})})
 * @ORM\Entity(repositoryClass="HousingBundle\Repository\ReviewsRepository")
 */
class Ratings
{
    /**
     * @var string
     *
     * @ORM\Column(name="feedback", type="string", length=255, nullable=false)
     */
    private $feedback;

    /**
     * @var \HousingBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="HousingBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="idu")
     * })
     */
    private $iduser;

    /**
     * @var integer
     *
     * @ORM\Column(name="rating", type="integer", nullable=false)
     */
    private $rating;

    /**
     * @var integer
     *
     * @ORM\Column(name="idR", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idr;

    /**
     * @var \HousingBundle\Entity\Housing
     *
     * @ORM\ManyToOne(targetEntity="HousingBundle\Entity\Housing")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idh", referencedColumnName="idh")
     * })
     */
    private $idh;

    /**
     * @return string
     */
    public function getFeedback()
    {
        return $this->feedback;
    }

    /**
     * @param string $feedback
     */
    public function setFeedback($feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * @return User
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * @param User $iduser
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;
    }



    /**
     * @return int
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param int $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return int
     */
    public function getIdr()
    {
        return $this->idr;
    }

    /**
     * @param int $idr
     */
    public function setIdr($idr)
    {
        $this->idr = $idr;
    }

    /**
     * @return Housing
     */
    public function getIdh()
    {
        return $this->idh;
    }

    /**
     * @param Housing $idh
     */
    public function setIdh($idh)
    {
        $this->idh = $idh;
    }


}

