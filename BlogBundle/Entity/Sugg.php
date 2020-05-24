<?php

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sugg
 *
 * @ORM\Table(name="sugg")
 * @ORM\Entity
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
     * @var integer
     *
     * @ORM\Column(name="id_cmp", type="integer", nullable=true)
     */
    private $idCmp = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="detail", type="string", length=60, nullable=true)
     */
    private $detail = 'NULL';



    /**
     * Get idSugg
     *
     * @return integer
     */
    public function getIdSugg()
    {
        return $this->idSugg;
    }

    /**
     * Set idCmp
     *
     * @param integer $idCmp
     *
     * @return Sugg
     */
    public function setIdCmp($idCmp)
    {
        $this->idCmp = $idCmp;

        return $this;
    }

    /**
     * Get idCmp
     *
     * @return integer
     */
    public function getIdCmp()
    {
        return $this->idCmp;
    }

    /**
     * Set detail
     *
     * @param string $detail
     *
     * @return Sugg
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;

        return $this;
    }

    /**
     * Get detail
     *
     * @return string
     */
    public function getDetail()
    {
        return $this->detail;
    }
}
