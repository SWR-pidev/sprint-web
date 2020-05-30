<?php

namespace HousingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Housing
 *
 * @ORM\Table(name="housing")
 * @UniqueEntity("name")
 * @ORM\Entity(repositoryClass="HousingBundle\Repository\HousingRepository")
 */
class Housing
{
    /**
     * @return int
     */
    public function getIdh()
    {
        return $this->idh;
    }

    /**
     * @param int $idh
     */
    public function setIdh($idh)
    {
        $this->idh = $idh;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return int
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * @param int $capacity
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
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
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getNbresidents()
    {
        return $this->nbresidents;
    }

    /**
     * @param int $nbresidents
     */
    public function setNbresidents($nbresidents)
    {
        $this->nbresidents = $nbresidents;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
    /**
     * @var integer
     *
     * @ORM\Column(name="idh", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idh;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Length(min="1", max="30")
     * @ORM\Column(name="address", type="string", length=30, nullable=false)
     */
    private $address;

    /**
     * @var integer
     * @Assert\NotBlank
     * @Assert\Length(min="1", max="1000")
     * @Assert\Range(min = 1,max = 2000,minMessage = "This Housing must have atleast 1 resident",maxMessage = "This Housing must have a maximum of 2000 residents")
     * @ORM\Column(name="capacity", type="integer", nullable=false)
     */
    private $capacity;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Regex("/^\w+/")
     * @Assert\Length(min="5", max="200")
     * @ORM\Column(name="description", type="string", length=200, nullable=false)
     */
    private $description;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Regex("^[[](\-?([0-8]?[0-9](\.\d+)?|90(.[0]+)?)?[,]\s?)+(\-?([1]?[0-7]?[0-9](\.\d+)?|180((.[0]+)?)))]$^")
     * @ORM\Column(name="location", type="string", length=50, nullable=false)
     */
    private $location;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Length(min="5", max="50")
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var integer
     * @Assert\NotBlank
     * @Assert\Range(min = 1,max = 2000,minMessage = "This Housing must have atleast 1 resident",maxMessage = "This Housing must have a maximum of 2000 residents")
     * @ORM\Column(name="nbresidents", type="integer", nullable=false)
     */
    private $nbresidents;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Length(min="1", max="20")
     * @Assert\Choice({"Camp","House"})
     * @ORM\Column(name="type", type="string", length=20, nullable=false)
     */
    private $type;




}

