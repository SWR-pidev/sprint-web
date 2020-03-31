<?php

namespace HousingBundle\Entity;

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
    private $stateEvt;

    /**
     * @var float
     *
     * @ORM\Column(name="stillneeded_evt", type="float", precision=10, scale=0, nullable=false)
     */
    private $stillneededEvt = '0';


}

