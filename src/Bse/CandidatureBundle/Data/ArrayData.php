<?php

namespace Bse\CandidatureBundle\Data;

class ArrayData
{

	public function getFilieresData()
    {
    	$data =array(
			'Qualité du logiciel',
			'Energies Renouvelables',
			'Qualité du logiciel',
			'Biotechnologies Alimentaires',
		);
		return $data;

    }

    public function getEtablissementsData()
    {
    	$data =array(
			'Université Ibn Tofail',
			'Autre',			
		);
		return $data;

    }

    public function getTypesDiplomeData()
    {
    	$data =array(
			'Licence Fondamentale',
			'Licence Professionnelle',			
		);
		return $data;

    }

    public function getMentionsData()
    {
    	$data =array(
			'Passable',
			'Assez bien',
			'Bien',
			'Très bien',
			'Excellent',
		);
		return $data;

    }

    public function getPaysData()
    {
    	$data =array(
			'Maroc',
			'Autre',			
		);
		return $data;

    }

}