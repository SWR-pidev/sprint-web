<?php

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ratings
 *
 * @ORM\Table(name="ratings")
 * @ORM\Entity
 */
class Ratings
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idR", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idr;

    /**
     * @var integer
     *
     * @ORM\Column(name="idh", type="integer", nullable=false)
     */
    private $idh;

    /**
     * @var integer
     *
     * @ORM\Column(name="idUser", type="integer", nullable=false)
     */
    private $iduser;

    /**
     * @var string
     *
     * @ORM\Column(name="feedback", type="string", length=50, nullable=false)
     */
    private $feedback;

    /**
     * @var integer
     *
     * @ORM\Column(name="rating", type="integer", nullable=false)
     */
    private $rating;



    /**
     * Get idr
     *
     * @return integer
     */
    public function getIdr()
    {
        return $this->idr;
    }

    /**
     * Set idh
     *
     * @param integer $idh
     *
     * @return Ratings
     */
    public function setIdh($idh)
    {
        $this->idh = $idh;

        return $this;
    }

    /**
     * Get idh
     *
     * @return integer
     */
    public function getIdh()
    {
        return $this->idh;
    }

    /**
     * Set iduser
     *
     * @param integer $iduser
     *
     * @return Ratings
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

    /**
     * Set feedback
     *
     * @param string $feedback
     *
     * @return Ratings
     */
    public function setFeedback($feedback)
    {
        $this->feedback = $feedback;

        return $this;
    }

    /**
     * Get feedback
     *
     * @return string
     */
    public function getFeedback()
    {
        return $this->feedback;
    }

    /**
     * Set rating
     *
     * @param integer $rating
     *
     * @return Ratings
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return integer
     */
    public function getRating()
    {
        return $this->rating;
    }
}
