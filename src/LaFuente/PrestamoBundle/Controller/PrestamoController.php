<?php

namespace LaFuente\PrestamoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use LaFuente\PrestamoBundle\Entity\Prestamo;
use LaFuente\PrestamoBundle\Entity\Mate;
use LaFuente\PrestamoBundle\Entity\Termo;
use LaFuente\PrestamoBundle\Entity\Pelota;
use LaFuente\PrestamoBundle\Entity\Paleta;
use LaFuente\PrestamoBundle\Entity\Bombilla;
use LaFuente\PrestamoBundle\Entity\Raqueta;


class PrestamoController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine();
        $prestamosActivos=$em->getRepository('LaFuentePrestamoBundle:Prestamo')->findByEstado("Activo");
        return $this->render('LaFuentePrestamoBundle:prestamo:index.html.twig', array(
          "prestamosFinalizados" => $prestamosActivos,
        ));

    }

    public function devolucionTotalAction(){
        $em = $this->getDoctrine();
        $prestamosActivos=$em->getRepository('LaFuentePrestamoBundle:Prestamo')->findByEstado("Activo");
        return $this->render('LaFuentePrestamoBundle:prestamo:index.html.twig', array(
          "prestamosFinalizados" => $prestamosActivos,
        ));

    }

}
