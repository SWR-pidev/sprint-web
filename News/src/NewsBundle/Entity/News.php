<?php

namespace NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * News
 *
 * @ORM\Table(name="news", uniqueConstraints={@ORM\UniqueConstraint(name="titre", columns={"titre"})}, indexes={@ORM\Index(name="nomcat", columns={"nomcat"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="NewsBundle\Repository\newsRepository")

 */
class News
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idn", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idn;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=30, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datepub", type="date", nullable=false)
     */
    private $datepub;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     */
    private $image;

    /**
     * @var integer
     *
     * @ORM\Column(name="view", type="integer", nullable=false)
     */
    private $view = '0';

    /**
     * @return int
     */
    public function getIdn()
    {
        return $this->idn;
    }

    /**
     * @param int $idn
     */
    public function setIdn($idn)
    {
        $this->idn = $idn;
    }

    /**
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return \DateTime
     */
    public function getDatepub()
    {
        return $this->datepub;
    }

    /**
     * @param \DateTime $datepub
     */
    public function setDatepub($datepub)
    {
        $this->datepub = $datepub;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return int
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @param int $view
     */
    public function setView($view)
    {
        $this->view = $view;
    }

    /**
     * @return string
     */
    public function getNomcat()
    {
        return $this->nomcat;
    }

    /**
     * @param string $nomcat
     */
    public function setNomcat($nomcat)
    {
        $this->nomcat = $nomcat;
    }

    /**
     * @var string
     *@ORM\Column(name="nomcat", type="string", length=255, nullable=false)
     */
    private $nomcat;


}

