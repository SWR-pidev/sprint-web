<?php

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Likes
 *
 * @ORM\Table(name="likes")
 * @ORM\Entity(repositoryClass="BlogBundle\Repository\BlogRepository")
 */
class Likes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idl", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idl;
    /**
     * @var integer
     *
     * @ORM\Column(name="iduser", type="integer", nullable=false)
     */
    private $iduser;

    /**
     * @var integer
     *
     * @ORM\Column(name="idP", type="integer", nullable=false)
     */
    private $idp;




    /**
     * Set idl
     *
     * @param integer $idl
     *
     * @return Likes
     */
    public function setIdl($idl)
    {
        $this->idl= $idl;

        return $this;
    }

    /**
     * Get idl
     *
     * @return integer
     */
    public function getIdl()
    {
        return $this->idl;
    }



    /**
     * Set iduser
     *
     * @param integer $iduser
     *
     * @return Likes
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;

        return $this;
    }

    /**
     * Get iduser
     *
     * @return integer
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * Set idp
     *
     * @param integer $idp
     *
     * @return Likes
     */
    public function setIdp($idp)
    {
        $this->idp = $idp;

        return $this;
    }

    /**
     * Get idp
     *
     * @return integer
     */
    public function getIdp()
    {
        return $this->idp;
    }
}
