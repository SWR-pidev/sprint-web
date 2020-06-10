<?php

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert ;

/**
 * Posts
 *
 * @ORM\Table(name="posts")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="BlogBundle\Repository\BlogRepository")
 */
class Posts
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idP", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idp;

    /**
     * @var string
     *
     * @ORM\Column(name="contenuP", type="string", length=500, nullable=false)
     */
    private $contenup;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbcmt", type="integer", nullable=true)
     */
    private $nbcmt = 'NULL';

    /**
     * @var integer
     *
     * @ORM\Column(name="views", type="integer", nullable=true)
     */
    private $views = 'NULL';

    /**
     * @var integer
     *
     * @ORM\Column(name="likes", type="integer", nullable=true)
     */
    private $likes = 'NULL';

    /**
     * @var integer
     *
     * @ORM\Column(name="report", type="integer", nullable=true)
     */
    private $report = 'NULL';

    /**
     * @var integer
     *
     * @ORM\Column(name="iduser", type="integer", nullable=false)
     */
    private $iduser;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateP", type="datetime", nullable=true)
     */
    private $datep = 'NULL';

    /**
     * @var string
     * @Assert\Image()
     * @ORM\Column(name="imgPost", type="string", length=255, nullable=false)
     */
    private $imgpost;



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
     * Set contenup
     *
     * @param string $contenup
     *
     * @return Posts
     */
    public function setContenup($contenup)
    {
        $this->contenup = $contenup;

        return $this;
    }

    /**
     * Get contenup
     *
     * @return string
     */
    public function getContenup()
    {
        return $this->contenup;
    }

    /**
     * Set nbcmt
     *
     * @param integer $nbcmt
     *
     * @return Posts
     */
    public function setNbcmt($nbcmt)
    {
        $this->nbcmt = $nbcmt;

        return $this;
    }

    /**
     * Get nbcmt
     *
     * @return integer
     */
    public function getNbcmt()
    {
        return $this->nbcmt;
    }

    /**
     * Set views
     *
     * @param integer $views
     *
     * @return Posts
     */
    public function setViews($views)
    {
        $this->views = $views;

        return $this;
    }

    /**
     * Get views
     *
     * @return integer
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * Set likes
     *
     * @param integer $likes
     *
     * @return Posts
     */
    public function setLikes($likes)
    {
        $this->likes = $likes;

        return $this;
    }

    /**
     * Get likes
     *
     * @return integer
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * Set report
     *
     * @param integer $report
     *
     * @return Posts
     */
    public function setReport($report)
    {
        $this->report = $report;

        return $this;
    }

    /**
     * Get report
     *
     * @return integer
     */
    public function getReport()
    {
        return $this->report;
    }

    /**
     * Set iduser
     *
     * @param integer $iduser
     *
     * @return Posts
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
     * Set datep
     *
     * @param \DateTime $datep
     *
     * @return Posts
     */
    public function setDatep($datep)
    {
        $this->datep = $datep;

        return $this;
    }

    /**
     * Get datep
     *
     * @return \DateTime
     */
    public function getDatep()
    {
        return $this->datep;
    }

    /**
     * Set imgpost
     *
     * @param string $imgpost
     *
     * @return Posts
     */
    public function setImgpost($imgpost)
    {
        $this->imgpost = $imgpost;

        return $this;
    }

    /**
     * Get imgpost
     *
     * @return string
     */
    public function getImgpost()
    {
        return $this->imgpost;
    }
}
