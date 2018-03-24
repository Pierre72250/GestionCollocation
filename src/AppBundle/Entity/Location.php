<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;


/**
 * Location
 *
 * @ORM\Table(name="location")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LocationRepository")
 */
class Location
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="code_postal", type="string", length=255)
     */
    private $codePostal;

    /**
     * @var float
     *
     * @ORM\Column(name="loyer_cc_m", type="float")
     */
    private $loyerCcM;

    /**
     * @var float
     *
     * @ORM\Column(name="charges", type="float")
     */
    private $charges;

    /**
     * @var float
     *
     * @ORM\Column(name="balcon", type="float")
     */
    private $balcon;

    /**
     * @var float
     *
     * @ORM\Column(name="surface_tot", type="float")
     */
    private $surfaceTot;

    /**
     * @var int
     *
     * @ORM\Column(name="annee_const", type="integer")
     */
    private $anneeConst;

    /**
     * @var int
     *
     * @ORM\Column(name="etage", type="integer")
     */
    private $etage;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_piece", type="integer")
     */
    private $nbPiece;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_chambre", type="integer")
     */
    private $nbChambre;

    /**
     * @var bool
     *
     * @ORM\Column(name="toilette", type="boolean")
     */
    private $toilette;

    /**
     * @var bool
     *
     * @ORM\Column(name="cuisine_equipee", type="boolean")
     */
    private $cuisineEquipee;

    /**
     * @var bool
     *
     * @ORM\Column(name="meuble", type="boolean")
     */
    private $meuble;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_parking", type="integer")
     */
    private $nbParking;

    /**
     * @var bool
     *
     * @ORM\Column(name="interphone", type="boolean")
     */
    private $interphone;

    /**
     * @var bool
     *
     * @ORM\Column(name="ascenseur", type="boolean")
     */
    private $ascenseur;

    /**
     * @var bool
     *
     * @ORM\Column(name="normes_andicap", type="boolean")
     */
    private $normesAndicap;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var User

     * @ManyToOne(targetEntity="AppBundle\Entity\User")
     * @JoinColumn(nullable=false)
     *
     */
    private $user;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Location
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Location
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set codePostal
     *
     * @param string $codePostal
     *
     * @return Location
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return string
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set loyerCcM
     *
     * @param float $loyerCcM
     *
     * @return Location
     */
    public function setLoyerCcM($loyerCcM)
    {
        $this->loyerCcM = $loyerCcM;

        return $this;
    }

    /**
     * Get loyerCcM
     *
     * @return float
     */
    public function getLoyerCcM()
    {
        return $this->loyerCcM;
    }

    /**
     * Set charges
     *
     * @param float $charges
     *
     * @return Location
     */
    public function setCharges($charges)
    {
        $this->charges = $charges;

        return $this;
    }

    /**
     * Get charges
     *
     * @return float
     */
    public function getCharges()
    {
        return $this->charges;
    }

    /**
     * Set balcon
     *
     * @param float $balcon
     *
     * @return Location
     */
    public function setBalcon($balcon)
    {
        $this->balcon = $balcon;

        return $this;
    }

    /**
     * Get balcon
     *
     * @return float
     */
    public function getBalcon()
    {
        return $this->balcon;
    }

    /**
     * Set surfaceTot
     *
     * @param float $surfaceTot
     *
     * @return Location
     */
    public function setSurfaceTot($surfaceTot)
    {
        $this->surfaceTot = $surfaceTot;

        return $this;
    }

    /**
     * Get surfaceTot
     *
     * @return float
     */
    public function getSurfaceTot()
    {
        return $this->surfaceTot;
    }

    /**
     * Set anneeConst
     *
     * @param integer $anneeConst
     *
     * @return Location
     */
    public function setAnneeConst($anneeConst)
    {
        $this->anneeConst = $anneeConst;

        return $this;
    }

    /**
     * Get anneeConst
     *
     * @return integer
     */
    public function getAnneeConst()
    {
        return $this->anneeConst;
    }

    /**
     * Set etage
     *
     * @param integer $etage
     *
     * @return Location
     */
    public function setEtage($etage)
    {
        $this->etage = $etage;

        return $this;
    }

    /**
     * Get etage
     *
     * @return integer
     */
    public function getEtage()
    {
        return $this->etage;
    }

    /**
     * Set nbPiece
     *
     * @param integer $nbPiece
     *
     * @return Location
     */
    public function setNbPiece($nbPiece)
    {
        $this->nbPiece = $nbPiece;

        return $this;
    }

    /**
     * Get nbPiece
     *
     * @return integer
     */
    public function getNbPiece()
    {
        return $this->nbPiece;
    }

    /**
     * Set nbChambre
     *
     * @param integer $nbChambre
     *
     * @return Location
     */
    public function setNbChambre($nbChambre)
    {
        $this->nbChambre = $nbChambre;

        return $this;
    }

    /**
     * Get nbChambre
     *
     * @return integer
     */
    public function getNbChambre()
    {
        return $this->nbChambre;
    }

    /**
     * Set toilette
     *
     * @param boolean $toilette
     *
     * @return Location
     */
    public function setToilette($toilette)
    {
        $this->toilette = $toilette;

        return $this;
    }

    /**
     * Get toilette
     *
     * @return boolean
     */
    public function getToilette()
    {
        return $this->toilette;
    }

    /**
     * Set cuisineEquipee
     *
     * @param boolean $cuisineEquipee
     *
     * @return Location
     */
    public function setCuisineEquipee($cuisineEquipee)
    {
        $this->cuisineEquipee = $cuisineEquipee;

        return $this;
    }

    /**
     * Get cuisineEquipee
     *
     * @return boolean
     */
    public function getCuisineEquipee()
    {
        return $this->cuisineEquipee;
    }

    /**
     * Set meuble
     *
     * @param boolean $meuble
     *
     * @return Location
     */
    public function setMeuble($meuble)
    {
        $this->meuble = $meuble;

        return $this;
    }

    /**
     * Get meuble
     *
     * @return boolean
     */
    public function getMeuble()
    {
        return $this->meuble;
    }

    /**
     * Set nbParking
     *
     * @param integer $nbParking
     *
     * @return Location
     */
    public function setNbParking($nbParking)
    {
        $this->nbParking = $nbParking;

        return $this;
    }

    /**
     * Get nbParking
     *
     * @return integer
     */
    public function getNbParking()
    {
        return $this->nbParking;
    }

    /**
     * Set interphone
     *
     * @param boolean $interphone
     *
     * @return Location
     */
    public function setInterphone($interphone)
    {
        $this->interphone = $interphone;

        return $this;
    }

    /**
     * Get interphone
     *
     * @return boolean
     */
    public function getInterphone()
    {
        return $this->interphone;
    }

    /**
     * Set ascenseur
     *
     * @param boolean $ascenseur
     *
     * @return Location
     */
    public function setAscenseur($ascenseur)
    {
        $this->ascenseur = $ascenseur;

        return $this;
    }

    /**
     * Get ascenseur
     *
     * @return boolean
     */
    public function getAscenseur()
    {
        return $this->ascenseur;
    }

    /**
     * Set normesAndicap
     *
     * @param boolean $normesAndicap
     *
     * @return Location
     */
    public function setNormesAndicap($normesAndicap)
    {
        $this->normesAndicap = $normesAndicap;

        return $this;
    }

    /**
     * Get normesAndicap
     *
     * @return boolean
     */
    public function getNormesAndicap()
    {
        return $this->normesAndicap;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Location
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
}
