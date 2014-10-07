<?php

namespace Bse\InscriptionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inscription
 *
 * @ORM\Table(name="inscription")
 * @ORM\Entity
 */
class Inscription
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="CIN", type="string", length=45, nullable=true)
     */
    private $cin;

    /**
     * @var string
     *
     * @ORM\Column(name="CNE", type="string", length=12, nullable=true)
     */
    private $cne;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=65, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=65, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="text", nullable=true)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="tel_mobile", type="string", length=45, nullable=true)
     */
    private $telMobile;

    /**
     * @var string
     *
     * @ORM\Column(name="tel_fixe", type="string", length=45, nullable=true)
     */
    private $telFixe;

    /**
     * @var float
     *
     * @ORM\Column(name="note_s1", type="float", precision=10, scale=0, nullable=true)
     */
    private $noteS1;

    /**
     * @var float
     *
     * @ORM\Column(name="note_s2", type="float", precision=10, scale=0, nullable=true)
     */
    private $noteS2;

    /**
     * @var float
     *
     * @ORM\Column(name="note_s3", type="float", precision=10, scale=0, nullable=true)
     */
    private $noteS3;

    /**
     * @var float
     *
     * @ORM\Column(name="note_s4", type="float", precision=10, scale=0, nullable=true)
     */
    private $noteS4;

    /**
     * @var float
     *
     * @ORM\Column(name="note_s5", type="float", precision=10, scale=0, nullable=true)
     */
    private $noteS5;

    /**
     * @var float
     *
     * @ORM\Column(name="note_s6", type="float", precision=10, scale=0, nullable=true)
     */
    private $noteS6;

    /**
     * @var string
     *
     * @ORM\Column(name="filiere_1", type="string", length=150, nullable=true)
     */
    private $filiere1;

    /**
     * @var string
     *
     * @ORM\Column(name="filiere_2", type="string", length=150, nullable=true)
     */
    private $filiere2;

    /**
     * @var string
     *
     * @ORM\Column(name="filiere_3", type="string", length=150, nullable=true)
     */
    private $filiere3;

    /**
     * @var string
     *
     * @ORM\Column(name="filiere_4", type="string", length=150, nullable=true)
     */
    private $filiere4;

    /**
     * @var string
     *
     * @ORM\Column(name="filiere_5", type="string", length=150, nullable=true)
     */
    private $filiere5;



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
     * Set cin
     *
     * @param string $cin
     * @return Inscription
     */
    public function setCin($cin)
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * Get cin
     *
     * @return string 
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * Set cne
     *
     * @param string $cne
     * @return Inscription
     */
    public function setCne($cne)
    {
        $this->cne = $cne;

        return $this;
    }

    /**
     * Get cne
     *
     * @return string 
     */
    public function getCne()
    {
        return $this->cne;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Inscription
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
     * @return Inscription
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
     * Set email
     *
     * @param string $email
     * @return Inscription
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Inscription
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
     * Set telMobile
     *
     * @param string $telMobile
     * @return Inscription
     */
    public function setTelMobile($telMobile)
    {
        $this->telMobile = $telMobile;

        return $this;
    }

    /**
     * Get telMobile
     *
     * @return string 
     */
    public function getTelMobile()
    {
        return $this->telMobile;
    }

    /**
     * Set telFixe
     *
     * @param string $telFixe
     * @return Inscription
     */
    public function setTelFixe($telFixe)
    {
        $this->telFixe = $telFixe;

        return $this;
    }

    /**
     * Get telFixe
     *
     * @return string 
     */
    public function getTelFixe()
    {
        return $this->telFixe;
    }

    /**
     * Set noteS1
     *
     * @param float $noteS1
     * @return Inscription
     */
    public function setNoteS1($noteS1)
    {
        $this->noteS1 = $noteS1;

        return $this;
    }

    /**
     * Get noteS1
     *
     * @return float 
     */
    public function getNoteS1()
    {
        return $this->noteS1;
    }

    /**
     * Set noteS2
     *
     * @param float $noteS2
     * @return Inscription
     */
    public function setNoteS2($noteS2)
    {
        $this->noteS2 = $noteS2;

        return $this;
    }

    /**
     * Get noteS2
     *
     * @return float 
     */
    public function getNoteS2()
    {
        return $this->noteS2;
    }

    /**
     * Set noteS3
     *
     * @param float $noteS3
     * @return Inscription
     */
    public function setNoteS3($noteS3)
    {
        $this->noteS3 = $noteS3;

        return $this;
    }

    /**
     * Get noteS3
     *
     * @return float 
     */
    public function getNoteS3()
    {
        return $this->noteS3;
    }

    /**
     * Set noteS4
     *
     * @param float $noteS4
     * @return Inscription
     */
    public function setNoteS4($noteS4)
    {
        $this->noteS4 = $noteS4;

        return $this;
    }

    /**
     * Get noteS4
     *
     * @return float 
     */
    public function getNoteS4()
    {
        return $this->noteS4;
    }

    /**
     * Set noteS5
     *
     * @param float $noteS5
     * @return Inscription
     */
    public function setNoteS5($noteS5)
    {
        $this->noteS5 = $noteS5;

        return $this;
    }

    /**
     * Get noteS5
     *
     * @return float 
     */
    public function getNoteS5()
    {
        return $this->noteS5;
    }

    /**
     * Set noteS6
     *
     * @param float $noteS6
     * @return Inscription
     */
    public function setNoteS6($noteS6)
    {
        $this->noteS6 = $noteS6;

        return $this;
    }

    /**
     * Get noteS6
     *
     * @return float 
     */
    public function getNoteS6()
    {
        return $this->noteS6;
    }

    /**
     * Set filiere1
     *
     * @param string $filiere1
     * @return Inscription
     */
    public function setFiliere1($filiere1)
    {
        $this->filiere1 = $filiere1;

        return $this;
    }

    /**
     * Get filiere1
     *
     * @return string 
     */
    public function getFiliere1()
    {
        return $this->filiere1;
    }

    /**
     * Set filiere2
     *
     * @param string $filiere2
     * @return Inscription
     */
    public function setFiliere2($filiere2)
    {
        $this->filiere2 = $filiere2;

        return $this;
    }

    /**
     * Get filiere2
     *
     * @return string 
     */
    public function getFiliere2()
    {
        return $this->filiere2;
    }

    /**
     * Set filiere3
     *
     * @param string $filiere3
     * @return Inscription
     */
    public function setFiliere3($filiere3)
    {
        $this->filiere3 = $filiere3;

        return $this;
    }

    /**
     * Get filiere3
     *
     * @return string 
     */
    public function getFiliere3()
    {
        return $this->filiere3;
    }

    /**
     * Set filiere4
     *
     * @param string $filiere4
     * @return Inscription
     */
    public function setFiliere4($filiere4)
    {
        $this->filiere4 = $filiere4;

        return $this;
    }

    /**
     * Get filiere4
     *
     * @return string 
     */
    public function getFiliere4()
    {
        return $this->filiere4;
    }

    /**
     * Set filiere5
     *
     * @param string $filiere5
     * @return Inscription
     */
    public function setFiliere5($filiere5)
    {
        $this->filiere5 = $filiere5;

        return $this;
    }

    /**
     * Get filiere5
     *
     * @return string 
     */
    public function getFiliere5()
    {
        return $this->filiere5;
    }
}
