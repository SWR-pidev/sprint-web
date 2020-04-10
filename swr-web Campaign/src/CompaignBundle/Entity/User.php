<?php

namespace CompaignBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
/**
 * User
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="nom", columns={"nom"}), @ORM\UniqueConstraint(name="mail", columns={"email"}), @ORM\UniqueConstraint(name="tel", columns={"tel"}), @ORM\UniqueConstraint(name="username", columns={"username"}), @ORM\UniqueConstraint(name="usernameCanonical", columns={"username_canonical"})})
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=30, nullable=false)
     */
    protected $nom;

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=30, nullable=false)
     */
    protected $prenom;

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=30, nullable=false)
     */
    protected $country;

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="tel", type="integer", nullable=false)
     */
    protected $tel;

    /**
     * @return int
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @param int $tel
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="radom", type="string", length=255, nullable=false)
     */
    protected $radom;

    /**
     * @return string
     */
    public function getRadom()
    {
        return $this->radom;
    }

    /**
     * @param string $radom
     */
    public function setRadom($radom)
    {
        $this->radom = $radom;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="iteration", type="integer", nullable=false)
     */
    protected $iteration = '3';

    /**
     * @return int
     */
    public function getIteration()
    {
        return $this->iteration;
    }

    /**
     * @param int $iteration
     */
    public function setIteration($iteration)
    {
        $this->iteration = $iteration;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     */
    protected $image;

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     * @return User
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateins", type="date", nullable=false)
     */
    protected $dateins;

    public function setDateins($dateins)
    {
        $this->dateins = $dateins;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateins()
    {
        return $this->dateins;
    }


    /**
     * @Assert\File(maxSize="9048k")
     * @Assert\Image(mimeTypesMessage="Please upload a valid image.")
     */
    protected $profilePictureFile;





    /**
     * Sets the file used for profile picture uploads
     *
     * @param UploadedFile $file
     * @return object
     */
    public function setProfilePictureFile(UploadedFile $file  ) {
        $this->profilePictureFile       =   $file;
        return $this;
    }

    /**
     * Get the file used for profile picture uploads
     *
     * @return UploadedFile
     */
    public function getProfilePictureFile() {

        return $this->profilePictureFile;
    }




    /**
     * Get the absolute path of the profilePicturePath
     */
    public function getProfilePictureAbsolutePath() {
        return null === $this->image
            ? null
            : $this->getUploadRootDir().'/'.$this->image;
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
        return 'uploads';
    }

    /**
     * Get the web path for the user
     *
     * @return string
     */
    public function getWebProfilePicturePath() {

        return '/'.$this->getUploadDir().'/'.$this->getImage();
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUploadProfilePicture() {
       /* if (null !== $this->getProfilePictureFile()) {
            // a file was uploaded
            // generate a unique filename
            $filename = $this->getProfilePictureFile();

           // $this->setImage($filename.'.'.$this->getProfilePictureFile()->guessExtension());
        }*/
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
        if ($this->getProfilePictureFile() === null) {
            return;
        }

        $filesystem = new Filesystem();
        $filesystem->copy($this->getProfilePictureFile(),$this->getUploadRootDir()."/".$this->getImage());



}



    public function __construct()
    {
        parent::__construct();
        $this->setDateins(new \DateTime());

    }

}
