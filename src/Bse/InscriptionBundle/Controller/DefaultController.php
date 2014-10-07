<?php

namespace Bse\InscriptionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BseInscriptionBundle:Default:index.html.twig', array('name' => $name));
    }
}
