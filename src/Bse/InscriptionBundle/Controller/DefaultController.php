<?php

namespace Bse\InscriptionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BseInscriptionBundle:Default:index.html.twig');
    }
}
