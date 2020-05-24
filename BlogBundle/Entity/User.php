<?php
        // src/AppBundle/Entity/User.php

        namespace AppBundle\Entity;
        namespace BlogBundle\Entity;
        use FOS\UserBundle\Model\User as BaseUser;
        use Doctrine\ORM\Mapping as ORM;

        /**
         * @ORM\Entity
         * @ORM\Table(name="user")
         */
        class User extends BaseUser
        {
            /**
             * @ORM\Id
             * @ORM\Column(type="integer")
             * @ORM\GeneratedValue(strategy="AUTO")
             */
            protected $id;

            public function __construct()
            {
                parent::__construct();
                // your own logic
            }
            /**
             * @var string
             *
             * @ORM\Column(name="nom", type="string", length=30, nullable=true)
             */

            protected $nom;

            /**
             * @var string
             *
             * @ORM\Column(name="prenom", type="string", length=30, nullable=true)
             */
            protected $prenom;

            /**
             * @var string
             *
             * @ORM\Column(name="country", type="string", length=30, nullable=true)
             */
            protected $country;


            /**
             * @var integer
             *
             * @ORM\Column(name="tel", type="integer", nullable=true)
             */
            protected $tel;


            /**
             * @var \DateTime
             *
             * @ORM\Column(name="dateins", type="date", nullable=true)
             */
            protected $dateins;

            /**
             * @var string
             *
             * @ORM\Column(name="radom", type="string", length=255, nullable=true)
             */
            protected $radom;

            /**
             * @var integer
             *
             * @ORM\Column(name="iteration", type="integer", nullable=false)
             */
            protected $iteration = '3';

            /**
             * @var string
             *
             * @ORM\Column(name="image", type="string", length=255, nullable=true)
             */
            protected $image;



            /**
             * Get idu
             *
             * @return integer
             */
            public function getIdu()
            {
                return $this->idu;
            }

            /**
             * Set nom
             *
             * @param string $nom
             *
             * @return User
             */
            public function setNom($nom)
            {
                $this->nom = $nom;

                return $this;
            }

            /**
             * Get nom
             *
             * @return string
             */
            public function getNom()
            {
                return $this->nom;
            }

            /**
             * Set prenom
             *
             * @param string $prenom
             *
             * @return User
             */
            public function setPrenom($prenom)
            {
                $this->prenom = $prenom;

                return $this;
            }

            /**
             * Get prenom
             *
             * @return string
             */
            public function getPrenom()
            {
                return $this->prenom;
            }

            /**
             * Set country
             *
             * @param string $country
             *
             * @return User
             */
            public function setCountry($country)
            {
                $this->country = $country;

                return $this;
            }

            /**
             * Get country
             *
             * @return string
             */
            public function getCountry()
            {
                return $this->country;
            }





            /**
             * Set tel
             *
             * @param integer $tel
             *
             * @return User
             */
            public function setTel($tel)
            {
                $this->tel = $tel;

                return $this;
            }

            /**
             * Get tel
             *
             * @return integer
             */
            public function getTel()
            {
                return $this->tel;
            }


            /**
             * Set dateins
             *
             * @param \DateTime $dateins
             *
             * @return User
             */
            public function setDateins($dateins)
            {
                $this->dateins = $dateins;

                return $this;
            }

            /**
             * Get dateins
             *
             * @return \DateTime
             */
            public function getDateins()
            {
                return $this->dateins;
            }

            /**
             * Set radom
             *
             * @param string $radom
             *
             * @return User
             */
            public function setRadom($radom)
            {
                $this->radom = $radom;

                return $this;
            }

            /**
             * Get radom
             *
             * @return string
             */
            public function getRadom()
            {
                return $this->radom;
            }

            /**
             * Set iteration
             *
             * @param integer $iteration
             *
             * @return User
             */
            public function setIteration($iteration)
            {
                $this->iteration = $iteration;

                return $this;
            }

            /**
             * Get iteration
             *
             * @return integer
             */
            public function getIteration()
            {
                return $this->iteration;
            }

            /**
             * Set image
             *
             * @param string $image
             *
             * @return User
             */
            public function setImage($image)
            {
                $this->image = $image;

                return $this;
            }

            /**
             * Get image
             *
             * @return string
             */
            public function getImage()
            {
                return $this->image;
            }

        }