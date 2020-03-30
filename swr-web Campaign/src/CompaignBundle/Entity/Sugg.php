<?php

namespace CompaignBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use CompaignBundle\Entity\Compaign;

/**
 * Sugg
 * @ORM\Entity(repositoryClass="CompaignBundle\Repository\CompaignRepository")
 * @ORM\Table(name="sugg", indexes={@ORM\Index(name="id_cmp", columns={"id_cmp"})})
 * @ORM\HasLifecycleCallbacks()
 */
class Sugg
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_sugg", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSugg;

    /**
     * @var string
     *
     * @ORM\Column(name="detail", type="string", length=60, nullable=true)
     */
    private $detail ;

    /**
     *
     *
     * @ORM\ManyToOne(targetEntity="Compaign")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cmp", referencedColumnName="id_cmp")
     * })
     */
    private $idCmp;

    /**
     * @return int
     */
    public function getIdSugg()
    {
        return $this->idSugg;
    }

    /**
     * @param int $idSugg
     */
    public function setIdSugg($idSugg)
    {
        $this->idSugg = $idSugg;
    }

    /**
     * @return string
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * @param string $detail
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;
    }

    /**
     * @return mixed
     */
    public function getIdCmp()
    {
        return $this->idCmp;
    }

    /**
     * @param mixed $idCmp
     */
    public function setIdCmp($idCmp)
    {
        $this->idCmp = $idCmp;
    }
   private $name;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }


}
