<?php

namespace HousingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Items
 * @ORM\Table(name="items", indexes={@ORM\Index(name="fk_hi", columns={"idh"})})
 * @ORM\Entity(repositoryClass="HousingBundle\Repository\ItemsRepository")
 */
class Items
{
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
    public function getExpdate()
    {
        return $this->expdate;
    }

    /**
     * @param string $expdate
     */
    public function setExpdate($expdate)
    {
        $this->expdate = $expdate;
    }

    /**
     * @return int
     */
    public function getIditem()
    {
        return $this->iditem;
    }

    /**
     * @param int $iditem
     */
    public function setIditem($iditem)
    {
        $this->iditem = $iditem;
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
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return \Housing
     */
    public function getIdh()
    {
        return $this->idh;
    }

    /**
     * @param \Housing $idh
     */
    public function setIdh($idh)
    {
        $this->idh = $idh;
    }
    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Length(min="1", max="100")
     * @ORM\Column(name="description", type="string", length=100, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="expdate", type="string", length=15, nullable=true)
     */
    private $expdate;

    /**
     * @var integer
     *
     * @ORM\Column(name="idItem", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iditem;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Length(min="3", max="30")
     * @ORM\Column(name="name", type="string", length=30, nullable=false)
     */
    private $name;

    /**
     * @var integer
     * @Assert\NotBlank
     * @Assert\Range(min = 1,max = 5000,minMessage = "Items needed Must be atleast 1 ",maxMessage = "You can't get more than 5000 let's be real :) ")
     * @ORM\Column(name="quantity", type="integer", nullable=false)
     */
    private $quantity;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Length(min="1", max="15")
     * @Assert\Choice({"Collected","Waiting"})
     * @ORM\Column(name="status", type="string", length=15, nullable=false)
     */
    private $status;

    /**
     * @var \Housing
     *
     * @ORM\ManyToOne(targetEntity="Housing")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idh", referencedColumnName="idh")
     * })
     */
    private $idh;


}

