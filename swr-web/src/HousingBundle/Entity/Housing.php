<?php

namespace HousingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Housing
 *
 * @ORM\Table(name="housing")
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
     *
     * @ORM\Column(name="address", type="string", length=30, nullable=false)
     */
    private $address;

    /**
     * @var integer
     *
     * @ORM\Column(name="capacity", type="integer", nullable=false)
     */
    private $capacity;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=200, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=50, nullable=false)
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbresidents", type="integer", nullable=false)
     */
    private $nbresidents;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=20, nullable=false)
     */
    private $type;




}
