<?php

namespace LaFuente\CertificadoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class TemplateController extends Controller
{
    public function indexAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$job = $em->getRepository('LaFuenteCertificadoBundle:Jobs')->findOneById($id);
    	$data = array(
    		'nombre' => "Juan Domingo Perón",
    		'dni' => '11000000',
    		'tipo' => $job->getTipoCertificado(),
    		'titulo' => $job -> getTitulo(),
    	);
    	$twig = new \Twig_Environment(new \Twig_Loader_String());
		$curpo = $twig->render($job->getCuerpo(), $data);
		$data = array(
    		'firmantes' => $job->getFirmantes(),
    		'cantFirmantes' => count($job->getFirmantes()),
    		'titulo' => $job -> getTitulo(),
    		'cuerpo' => $curpo
    	);
        return $this->render('LaFuenteCertificadoBundle:template:index.html.twig', $data);
    }
}
