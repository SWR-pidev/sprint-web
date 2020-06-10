<?php

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Housing
 *
 * @ORM\Table(name="housing")
 * @ORM\Entity
 */
class Housing
{
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
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=200, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=30, nullable=false)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=50, nullable=false)
     */
    private $location;

    /**
     * @var integer
     *
     * @ORM\Column(name="capacity", type="integer", nullable=false)
     */
    private $capacity;

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
     * Set name
     *
     * @param string $name
     *
     * @return Housing
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Housing
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Housing
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return Housing
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set capacity
     *
     * @param integer $capacity
     *
     * @return Housing
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * Get capacity
     *
     * @return integer
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * Set nbresidents
     *
     * @param integer $nbresidents
     *
     * @return Housing
     */
    public function setNbresidents($nbresidents)
    {
        $this->nbresidents = $nbresidents;

        return $this;
    }

    /**
     * Get nbresidents
     *
     * @return integer
     */
    public function getNbresidents()
    {
        return $this->nbresidents;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Housing
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
