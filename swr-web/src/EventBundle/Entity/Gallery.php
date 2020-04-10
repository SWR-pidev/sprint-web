<?php

namespace EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Filesystem\Filesystem;
/**
 * Gallery
 *
 * @ORM\Table(name="gallery", indexes={@ORM\Index(name="id_evtG", columns={"id_evtG"})})
 * @ORM\Entity(repositoryClass="EventBundle\Repository\GalleryRepository")
 */
class Gallery
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idG", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idg;

    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=85, nullable=false)
     */
    private $img;

    /**
     *
     *
     * @ORM\ManyToOne(targetEntity="Event")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_evtG", referencedColumnName="id_evt")
     * })
     */
    private $idEvtg;

    /**
     * @return int
     */
    public function getIdg()
    {
        return $this->idg;
    }

    /**
     * @param int $idg
     */
    public function setIdg($idg)
    {
        $this->idg = $idg;
    }

    /**
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param string $img
     */
    public function setImg($img)
    {
        $this->img = $img;
    }

    /**
     * @return mixed
     */
    public function getIdEvtg()
    {
        return $this->idEvtg;
    }

    /**
     * @param mixed $idEvtg
     */
    public function setIdEvtg($idEvtg)
    {
        $this->idEvtg = $idEvtg;
    }


}

