<?php

namespace Bse\CandidatureBundle\Entity;

use Bse\CandidatureBundle\Entity\Candidature;


/**
 * CustomCandidature
 * 
 * @ORM\MappedSuperclass
 * @ORM\Table(name="Candidature")
 * @ORM\Entity
 */
class CustomCandidature extends Candidature {

	/**
     * @var string     
     */
    private $motDePasse;



    /**
     * Get motDePasse
     *
     * @return string 
     */
    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    /**
     * Set motDePasse
     *
     * @param string $motDePasse
     * @return Candidature
     */
    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }

}