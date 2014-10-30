<?php

namespace Bse\CandidatureBundle\Data;

class ArrayData
{

	public function getFilieresData()
    {
    	$data_1 =array(
			'Mathématiques et applications',
			'Ingénierie des matériaux : traitement, caractérisation et contrôle de qualité',
			'Chimie organique et Environnement',
			'Sciences des matériaux',
			'Management qualité, Hygiène, Sécurité et Environnement',
			'Systèmes de protection des métaux : conception et environnement',
			'Génie des matériaux et technolgies des céramiques et ciments',
			'Electronique embarquée et systèmes de télécommunication',
			'Energétique - Mécanique des fluides',
			'Sciences et techniques nucléaires',
			'Energies Renouvelables',
			'Physique de la matière condensée',
			'Hydroinformatique et Gestion des Hydrosystèmes',
			'Neurocognition humaine et santé de la population',
			'Biologie - Santé - Environnement',
			'Nutrition humaine, Sécurité alimentaire et Management de la qualité',
			'MASTER SPÉCIALISÉ MÉTIERS D’ENSEIGNEMENT ET DE FORMATION EN PHYSIQUE-CHIMIE',
			'MASTER SPÉCIALISÉ MÉTIERS D’ENSEIGNEMENT ET DE FORMATION',
			'Informatique'
		);

		$data_2 = array(
			'مكونات الأدب العربي في  المغرب الحديث والمعاصر: التاريخ  والخطابية',
			'Langue française et diversité linguistique',			
			'Dynamique et gestion de l\'environnement',
			'Gestion Territoriale des risques environnementaux',
			'شمال إفريقيا وجنوب الصحراء',
			'Changement Climatiques , Ressources en Eau et développement durable au Maroc',
			'اللسانيات العربية والإعداد اللغوي',
			'اللهجات العربية والأدب الشفهي بالمغرب',
			'الاختلاف في العلوم الشرعية',
			'التواصل وتحليل الخطاب',
			'سوسيولوجبا التنمية المحلية',
			'Teaching English As A Foreign Language (TEFL)',
			'Master in Culture and linguistics',
			'Géographie et Aménagement'
		);

		$data_3 = array(
			'MARKETING ET LOGISTIQUE',
			'Management Audit et Contrôle',
			'BANQUE et ASSURANCE'
		);

		// $data = array($data_1);
		return $data_1;
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

    public function getFacultesData()
    {
    	$data =array(
			'FS'=>'Faculté des Sciences',
			'FL'=>'Faculté des Lettres et des Sciences Humaines',
			'FD'=>'Faculté de droit'
			// 'FE'=>'Faculté d\'economie',			
		);
		return $data;
    }

}