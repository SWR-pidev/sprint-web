<?php

namespace CompaignBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Compaign
 * @ORM\Entity(repositoryClass="CompaignBundle\Repository\CompaignRepository")
 * @ORM\Table(name="compaign")
 * @ORM\HasLifecycleCallbacks()
 */
class Compaign
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_cmp", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCmp;

    /**
     * @var string
     * @Assert\NotBlank(message="Please fill the name")
     * @Assert\Regex(
     *     pattern     = "/^[a-z]+$/i",
     *     htmlPattern = "^[a-zA-Z]+$",
     *     message="Name cannot contain a number or a symbol"
     * )
     * @ORM\Column(name="name_cmp", type="string", length=50, nullable=false)
     */
    private $nameCmp;

    /**
     * @var float
     * @Assert\NotBlank(message="Please fill the name")
     * @ORM\Column(name="target", type="float", precision=10, scale=0, nullable=false)
     */
    private $target;

    /**
     * @var float
     *
     * @ORM\Column(name="raised", type="float", precision=10, scale=0, nullable=false)
     */
    private $raised;

    /**
     * @var string
     * @Assert\NotBlank(message="Please fill the name")
     * @ORM\Column(name="descrip", type="string", length=100, nullable=false)
     */
    private $descrip;

    /**
     * @var string
     *
     * @ORM\Column(name="urlimg", type="string", length=100, nullable=false)
     */
    private $urlimg;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbdon", type="integer", nullable=false)
     */
    private $nbdon = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="stillneeded", type="integer", nullable=false)
     */
    private $stillneeded;

    /**
     * @return int
     */
    public function getIdCmp()
    {
        return $this->idCmp;
    }

    /**
     * @param int $idCmp
     */
    public function setIdCmp($idCmp)
    {
        $this->idCmp = $idCmp;
    }

    /**
     * @return string
     */
    public function getNameCmp()
    {
        return $this->nameCmp;
    }

    /**
     * @param string $nameCmp
     */
    public function setNameCmp($nameCmp)
    {
        $this->nameCmp = $nameCmp;
    }

    /**
     * @return float
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @param float $target
     */
    public function setTarget($target)
    {
        $this->target = $target;
    }

    /**
     * @return float
     */
    public function getRaised()
    {
        return $this->raised;
    }

    /**
     * @param float $raised
     */
    public function setRaised($raised)
    {
        $this->raised = $raised;
    }

    /**
     * @return string
     */
    public function getDescrip()
    {
        return $this->descrip;
    }

    /**
     * @param string $descrip
     */
    public function setDescrip($descrip)
    {
        $this->descrip = $descrip;
    }

    /**
     * @return string
     */
    public function getUrlimg()
    {
        return $this->urlimg;
    }

    /**
     * @param string $urlimg
     */
    public function setUrlimg($urlimg)
    {
        $this->urlimg = $urlimg;
    }

    /**
     * @return int
     */
    public function getNbdon()
    {
        return $this->nbdon;
    }

    /**
     * @param int $nbdon
     */
    public function setNbdon($nbdon)
    {
        $this->nbdon = $nbdon;
    }

    /**
     * @return int
     */
    public function getStillneeded()
    {
        return $this->stillneeded;
    }

    /**
     * @param int $stillneeded
     */
    public function setStillneeded($stillneeded)
    {
        $this->stillneeded = $stillneeded;
    }


}
