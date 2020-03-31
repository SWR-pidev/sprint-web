<?php
// src/AppBundle/Entity/User.php

 namespace AppBundle\Entity;

 use FOS\UserBundle\Model\User as BaseUser;
 use Doctrine\ORM\Mapping as ORM;

  /**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
 class User extends BaseUser
 {
     /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
 protected $id;

     /**
      * @return string|null
      */
     public function getConfirmationToken()
     {
         return $this->confirmationToken;
     }

     /**
      * @param string|null $confirmationToken
      */
     public function setConfirmationToken($confirmationToken)
     {
         $this->confirmationToken = $confirmationToken;
     }

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
      * @return mixed
      */
     public function getId()
     {
         return $this->id;
     }

     /**
      * @param mixed $id
      */
     public function setId($id)
     {
         $this->id = $id;
     }

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

 public function __construct()
 {
         parent::__construct();
 // your own logic
 }
 }