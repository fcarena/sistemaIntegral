<?php

namespace LaFuente\CertificadoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('LaFuenteCertificadoBundle:Default:index.html.twig');
    }
}
