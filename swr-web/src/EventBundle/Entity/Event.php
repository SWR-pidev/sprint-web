<?php

namespace EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Event
 * @ORM\Entity(repositoryClass="EventBundle\Repository\EventRepository")
 * @ORM\Table(name="event")
 */
class Event
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_evt", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEvt;

    /**
     * @var string
     * @Assert\NotBlank(message="Please fill the name")
     * @Assert\Regex(
     *     pattern     = "/^[a-z- ]+$/i",
     *     htmlPattern = "^[a-zA-Z- ]+$",
     *     message="Name cannot contain a number or a symbol"
     * )
     * @ORM\Column(name="name_evt", type="string", length=25, nullable=false)
     */
    private $nameEvt;

    /**
     * @var \DateTime
     *
     *
     *
     * @ORM\Column(name="date_evt", type="date", nullable=false)
     */
    private $dateEvt;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="please fill the time")
     * @ORM\Column(name="time_evt", type="time", nullable=false)
     */
    private $timeEvt;

    /**
     * @var string
     * @Assert\NotBlank(message="please fill the location")
     * @ORM\Column(name="location_evt", type="string", length=55, nullable=false)
     */
    private $locationEvt;

    /**
     * @var string
     * @Assert\NotBlank(message="please fill the details")
     * @ORM\Column(name="details_evt", type="string", length=85, nullable=false)
     */
    private $detailsEvt;

    /**
     * @var float
     * @Assert\NotBlank(message="please fill the budget")
     * @Assert\Regex(
     *      pattern="/^[0-9]+$/",
     *     message="Only numbers allowed")
     * @Assert\GreaterThan(0,message="Budget is a positive number")
     * @ORM\Column(name="budget_evt", type="float", precision=10, scale=0, nullable=false)
     */
    private $budgetEvt;

    /**
     * @var string
     * @Assert\NotBlank(message="please fill the Organizator name")
     *  @Assert\Regex(
     *     pattern     = "/^[a-z- ]+$/i",
     *     htmlPattern = "^[a-zA-Z- ]+$",
     *     message="Name cannot contain a number or a symbol")
     * @ORM\Column(name="organizator_evt", type="string", length=25, nullable=false)
     * @Assert\Valid()
     */
    private $organizatorEvt;

    /**
     * @var string
     *
     * @ORM\Column(name="url_evt", type="string", length=85, nullable=false)
     */
    private $urlEvt;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbviews_evt", type="integer", nullable=false)
     */
    private $nbviewsEvt = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="nbsponsor_evt", type="integer", nullable=false)
     */
    private $nbsponsorEvt = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="nbparticipant_evt", type="integer", nullable=false)
     */
    private $nbparticipantEvt = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="nbreport_evt", type="integer", nullable=false)
     */
    private $nbreportEvt = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="state_evt", type="integer", nullable=true)
     */
    private $stateEvt = 'NULL';

    /**
     * @var float
     *
     * @ORM\Column(name="stillneeded_evt", type="float", precision=10, scale=0, nullable=false)
     */
    private $stillneededEvt = '0';

    /**
     * @return string
     */
    public function getNameEvt()
    {
        return $this->nameEvt;
    }

    /**
     * @param string $nameEvt
     */
    public function setNameEvt($nameEvt)
    {
        $this->nameEvt = $nameEvt;
    }

    /**
     * @return \DateTime
     */
    public function getDateEvt()
    {
        return $this->dateEvt;
    }

    /**
     * @param \DateTime $dateEvt
     */
    public function setDateEvt($dateEvt)
    {
        $this->dateEvt = $dateEvt;
    }

    /**
     * @return \DateTime
     */
    public function getTimeEvt()
    {
        return $this->timeEvt;
    }

    /**
     * @param \DateTime $timeEvt
     */
    public function setTimeEvt($timeEvt)
    {
        $this->timeEvt = $timeEvt;
    }

    /**
     * @return string
     */
    public function getLocationEvt()
    {
        return $this->locationEvt;
    }

    /**
     * @param string $locationEvt
     */
    public function setLocationEvt($locationEvt)
    {
        $this->locationEvt = $locationEvt;
    }

    /**
     * @return string
     */
    public function getDetailsEvt()
    {
        return $this->detailsEvt;
    }

    /**
     * @param string $detailsEvt
     */
    public function setDetailsEvt($detailsEvt)
    {
        $this->detailsEvt = $detailsEvt;
    }

    /**
     * @return float
     */
    public function getBudgetEvt()
    {
        return $this->budgetEvt;
    }

    /**
     * @param float $budgetEvt
     */
    public function setBudgetEvt($budgetEvt)
    {
        $this->budgetEvt = $budgetEvt;
    }

    /**
     * @return string
     */
    public function getOrganizatorEvt()
    {
        return $this->organizatorEvt;
    }

    /**
     * @param string $organizatorEvt
     */
    public function setOrganizatorEvt($organizatorEvt)
    {
        $this->organizatorEvt = $organizatorEvt;
    }

    /**
     * @return string
     */
    public function getUrlEvt()
    {
        return $this->urlEvt;
    }

    /**
     * @param string $urlEvt
     */
    public function setUrlEvt($urlEvt)
    {
        $this->urlEvt = $urlEvt;
    }

    /**
     * @return int
     */
    public function getNbviewsEvt()
    {
        return $this->nbviewsEvt;
    }

    /**
     * @param int $nbviewsEvt
     */
    public function setNbviewsEvt($nbviewsEvt)
    {
        $this->nbviewsEvt = $nbviewsEvt;
    }

    /**
     * @return int
     */
    public function getNbsponsorEvt()
    {
        return $this->nbsponsorEvt;
    }

    /**
     * @param int $nbsponsorEvt
     */
    public function setNbsponsorEvt($nbsponsorEvt)
    {
        $this->nbsponsorEvt = $nbsponsorEvt;
    }

    /**
     * @return int
     */
    public function getNbparticipantEvt()
    {
        return $this->nbparticipantEvt;
    }

    /**
     * @param int $nbparticipantEvt
     */
    public function setNbparticipantEvt($nbparticipantEvt)
    {
        $this->nbparticipantEvt = $nbparticipantEvt;
    }

    /**
     * @return int
     */
    public function getNbreportEvt()
    {
        return $this->nbreportEvt;
    }

    /**
     * @param int $nbreportEvt
     */
    public function setNbreportEvt($nbreportEvt)
    {
        $this->nbreportEvt = $nbreportEvt;
    }

    /**
     * @return int
     */
    public function getStateEvt()
    {
        return $this->stateEvt;
    }

    /**
     * @param int $stateEvt
     */
    public function setStateEvt($stateEvt)
    {
        $this->stateEvt = $stateEvt;
    }

    /**
     * @return float
     */
    public function getStillneededEvt()
    {
        return $this->stillneededEvt;
    }

    /**
     * @param float $stillneededEvt
     */
    public function setStillneededEvt($stillneededEvt)
    {
        $this->stillneededEvt = $stillneededEvt;
    }

    /**
     * @return int
     */
    public function getIdEvt()
    {
        return $this->idEvt;
    }

    /**
     * @param int $idEvt
     */
    public function setIdEvt($idEvt)
    {
        $this->idEvt = $idEvt;
    }


    public function __construct()
    {
        $this->setDateEvt(new \DateTime());
    }

    private $images;

    /**
     * @return mixed
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param mixed $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }

    private $logo;

    /**
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param mixed $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

}

