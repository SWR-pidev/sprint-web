<?php

namespace EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
/**
 * User
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="nom", columns={"nom"}), @ORM\UniqueConstraint(name="mail", columns={"email"}), @ORM\UniqueConstraint(name="tel", columns={"tel"}), @ORM\UniqueConstraint(name="username", columns={"username"}), @ORM\UniqueConstraint(name="usernameCanonical", columns={"usernameCanonical"})})
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

    public function __construct()
    {
        parent::__construct();
        $this->setDateins(new \DateTime());

    }

}

