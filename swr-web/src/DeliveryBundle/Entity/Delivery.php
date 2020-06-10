<?php

namespace DeliveryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use Mgilet\NotificationBundle\Annotation\Notifiable;
use Mgilet\NotificationBundle\NotifiableInterface;


/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="DeliveryBundle\Repository\DeliveryRepository")
 * @ORM\Table(name="delivery")
 * @Notifiable(name="delivery")
 */

class Delivery implements NotifiableInterface
{

    /**
     * @var integer
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="IdDe", type="integer", nullable=false)
     * @ORM\Id

     */
    private $idde;

    /**
     * @var \Deliveryman
     *
     * @ORM\ManyToOne(targetEntity="DeliveryBundle\Entity\Deliveryman")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idDman", referencedColumnName="idDman")
     *
     * })
     */
    private $iddman;

    /**
     * @var \Housing
     *
     * @ORM\ManyToOne(targetEntity="Housing")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idh", referencedColumnName="idh")
     *
     * })
     */
    private $idh;


    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Regex("/^\w+/")
     * @Assert\Length(min="1", max="100")
     * @ORM\Column(name="DateD", type="string", length=20, nullable=false)
     */
    private $dated;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Regex("/^\w+/")
     * @Assert\Length(min="1", max="100")
     * @ORM\Column(name="item", type="string", length=20, nullable=false)
     */
    private $item;

    
    /**
     * @return int
     */
    public function getIdde()
    {
        return $this->idde;
    }


    /**
     * @return int
     */
    public function getIddman()
    {
        return $this->iddman;
    }

    /**
     * @param int $iddman
     */
    public function setIddman($iddman)
    {
        $this->iddman = $iddman;
    }

    /**
     * @return string
     */
    public function getDated()
    {
        return $this->dated;
    }

    /**
     * @param string $dated
     */
    public function setDated($dated)
    {
        $this->dated = $dated;
    }

    /**
     * @return string
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * @param string $item
     */
    public function setItem($item)
    {
        $this->item = $item;
    }
    /**
     * @return String
     */
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
}

