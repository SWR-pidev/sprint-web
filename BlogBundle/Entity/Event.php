<?php

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity
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
     *
     * @ORM\Column(name="name_evt", type="string", length=25, nullable=false)
     */
    private $nameEvt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_evt", type="date", nullable=false)
     */
    private $dateEvt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time_evt", type="time", nullable=false)
     */
    private $timeEvt;

    /**
     * @var string
     *
     * @ORM\Column(name="location_evt", type="string", length=55, nullable=false)
     */
    private $locationEvt;

    /**
     * @var string
     *
     * @ORM\Column(name="details_evt", type="string", length=255, nullable=false)
     */
    private $detailsEvt;

    /**
     * @var float
     *
     * @ORM\Column(name="budget_evt", type="float", precision=10, scale=0, nullable=false)
     */
    private $budgetEvt;

    /**
     * @var string
     *
     * @ORM\Column(name="organizator_evt", type="string", length=25, nullable=false)
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
     * Get idEvt
     *
     * @return integer
     */
    public function getIdEvt()
    {
        return $this->idEvt;
    }

    /**
     * Set nameEvt
     *
     * @param string $nameEvt
     *
     * @return Event
     */
    public function setNameEvt($nameEvt)
    {
        $this->nameEvt = $nameEvt;

        return $this;
    }

    /**
     * Get nameEvt
     *
     * @return string
     */
    public function getNameEvt()
    {
        return $this->nameEvt;
    }

    /**
     * Set dateEvt
     *
     * @param \DateTime $dateEvt
     *
     * @return Event
     */
    public function setDateEvt($dateEvt)
    {
        $this->dateEvt = $dateEvt;

        return $this;
    }

    /**
     * Get dateEvt
     *
     * @return \DateTime
     */
    public function getDateEvt()
    {
        return $this->dateEvt;
    }

    /**
     * Set timeEvt
     *
     * @param \DateTime $timeEvt
     *
     * @return Event
     */
    public function setTimeEvt($timeEvt)
    {
        $this->timeEvt = $timeEvt;

        return $this;
    }

    /**
     * Get timeEvt
     *
     * @return \DateTime
     */
    public function getTimeEvt()
    {
        return $this->timeEvt;
    }

    /**
     * Set locationEvt
     *
     * @param string $locationEvt
     *
     * @return Event
     */
    public function setLocationEvt($locationEvt)
    {
        $this->locationEvt = $locationEvt;

        return $this;
    }

    /**
     * Get locationEvt
     *
     * @return string
     */
    public function getLocationEvt()
    {
        return $this->locationEvt;
    }

    /**
     * Set detailsEvt
     *
     * @param string $detailsEvt
     *
     * @return Event
     */
    public function setDetailsEvt($detailsEvt)
    {
        $this->detailsEvt = $detailsEvt;

        return $this;
    }

    /**
     * Get detailsEvt
     *
     * @return string
     */
    public function getDetailsEvt()
    {
        return $this->detailsEvt;
    }

    /**
     * Set budgetEvt
     *
     * @param float $budgetEvt
     *
     * @return Event
     */
    public function setBudgetEvt($budgetEvt)
    {
        $this->budgetEvt = $budgetEvt;

        return $this;
    }

    /**
     * Get budgetEvt
     *
     * @return float
     */
    public function getBudgetEvt()
    {
        return $this->budgetEvt;
    }

    /**
     * Set organizatorEvt
     *
     * @param string $organizatorEvt
     *
     * @return Event
     */
    public function setOrganizatorEvt($organizatorEvt)
    {
        $this->organizatorEvt = $organizatorEvt;

        return $this;
    }

    /**
     * Get organizatorEvt
     *
     * @return string
     */
    public function getOrganizatorEvt()
    {
        return $this->organizatorEvt;
    }

    /**
     * Set urlEvt
     *
     * @param string $urlEvt
     *
     * @return Event
     */
    public function setUrlEvt($urlEvt)
    {
        $this->urlEvt = $urlEvt;

        return $this;
    }

    /**
     * Get urlEvt
     *
     * @return string
     */
    public function getUrlEvt()
    {
        return $this->urlEvt;
    }

    /**
     * Set nbviewsEvt
     *
     * @param integer $nbviewsEvt
     *
     * @return Event
     */
    public function setNbviewsEvt($nbviewsEvt)
    {
        $this->nbviewsEvt = $nbviewsEvt;

        return $this;
    }

    /**
     * Get nbviewsEvt
     *
     * @return integer
     */
    public function getNbviewsEvt()
    {
        return $this->nbviewsEvt;
    }

    /**
     * Set nbsponsorEvt
     *
     * @param integer $nbsponsorEvt
     *
     * @return Event
     */
    public function setNbsponsorEvt($nbsponsorEvt)
    {
        $this->nbsponsorEvt = $nbsponsorEvt;

        return $this;
    }

    /**
     * Get nbsponsorEvt
     *
     * @return integer
     */
    public function getNbsponsorEvt()
    {
        return $this->nbsponsorEvt;
    }

    /**
     * Set nbparticipantEvt
     *
     * @param integer $nbparticipantEvt
     *
     * @return Event
     */
    public function setNbparticipantEvt($nbparticipantEvt)
    {
        $this->nbparticipantEvt = $nbparticipantEvt;

        return $this;
    }

    /**
     * Get nbparticipantEvt
     *
     * @return integer
     */
    public function getNbparticipantEvt()
    {
        return $this->nbparticipantEvt;
    }

    /**
     * Set nbreportEvt
     *
     * @param integer $nbreportEvt
     *
     * @return Event
     */
    public function setNbreportEvt($nbreportEvt)
    {
        $this->nbreportEvt = $nbreportEvt;

        return $this;
    }

    /**
     * Get nbreportEvt
     *
     * @return integer
     */
    public function getNbreportEvt()
    {
        return $this->nbreportEvt;
    }

    /**
     * Set stateEvt
     *
     * @param integer $stateEvt
     *
     * @return Event
     */
    public function setStateEvt($stateEvt)
    {
        $this->stateEvt = $stateEvt;

        return $this;
    }

    /**
     * Get stateEvt
     *
     * @return integer
     */
    public function getStateEvt()
    {
        return $this->stateEvt;
    }

    /**
     * Set stillneededEvt
     *
     * @param float $stillneededEvt
     *
     * @return Event
     */
    public function setStillneededEvt($stillneededEvt)
    {
        $this->stillneededEvt = $stillneededEvt;

        return $this;
    }

    /**
     * Get stillneededEvt
     *
     * @return float
     */
    public function getStillneededEvt()
    {
        return $this->stillneededEvt;
    }
}
