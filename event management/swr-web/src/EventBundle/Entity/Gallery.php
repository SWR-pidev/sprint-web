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

    public $file;

    /**
     * Sets the file used for profile picture uploads
     *
     * @param UploadedFile $File
     * @return object
     */
    public function setFile(UploadedFile $File  ) {
        // set the value of the holder
        $this->file       =   $File;
        // check if we have an old image path

        // store the old name to delete after the update

        //$this->tempProfilePicturePath = $this->image;


        return $this;
    }

    /**
     * Get the file used for profile picture uploads
     *
     * @return UploadedFile
     */
    public function getFile() {

        return $this->file;
    }

    /**
     * Get the absolute path of the profilePicturePath
     */
    public function getProfilePictureAbsolutePath() {
        return null === $this->img
            ? null
            : $this->getUploadRootDir().'/'.$this->img;
    }
    /**
     * Get root directory for file uploads
     *
     * @return string
     */
    protected function getUploadRootDir() {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'\\..\\..\\..\\..\\swr\\web\\'.$this->getUploadDir();
    }

    /**
     * Specifies where in the /web directory profile pic uploads are stored
     *
     * @return string
     */
    protected function getUploadDir() {
        // the type param is to change these methods at a later date for more file uploads
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/Gallery';
    }
    /**
     * Get the web path for the user
     *
     * @return string
     */
    public function getWebProfilePicturePath() {

        return '/'.$this->getUploadDir().'/'.$this->getImg();
    }


    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     *
     * Upload the profile picture
     *
     * @return mixed
     */
    public function uploadProfilePicture() {

        // check there is a profile pic to upload
        if ($this->getFile() === null) {
            return;
        }

        $filesystem = new Filesystem();
        $this->setImg(uniqid('f_').'.'.'png');
        $filesystem->copy($this->getFile(),$this->getUploadRootDir()."/".$this->getImg());


    }

}

