<?php

namespace LaFuente\PrestamoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Security\Core\SecurityContext;


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
        $prestamosActivos=$em->getRepository('LaFuentePrestamoBundle:Prestamo')->findByEstado("Finalizado");
        return $this->render('LaFuentePrestamoBundle:prestamo:index.html.twig', array(
          "prestamosFinalizados" => $prestamosActivos,
        ));

    }

    public function devolucionTotalAction(Request $request,Prestamo $prestamo){
        $em = $this->getDoctrine()->getManager();
        $productos=$prestamo->getProducts();
        foreach ( $productos as $productoPrestamo) {
          $productoPrestamo->setDevueltoAt(new \DateTime());
          $productoPrestamo->setRecibidoBy($this->getUser());
          $producto=$productoPrestamo->getProduct();
          $producto->setAvailability(true);
          $em->persist($productoPrestamo);
          $em->persist($producto);
          $em->flush();
        }
        $prestamo->setFechaRecibido(new \DateTime());
        $prestamo->setEstado("Finalizado");
        $em->persist($prestamo);
        $em->flush();

        return $this->redirectToRoute('la_fuente_prestamo_homepage');
    }

      public function devolucionParcialAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $prestamo= $em->getRepository('LaFuentePrestamoBundle:Prestamo')->findOneById($request->request->get('prestamo'));
        $prestamo->setEstado("Parcialmente Finalizado");
        foreach ( $request->request->get('productosPrestamos') as $id) {
          $productoPrestamo= $em->getRepository('LaFuentePrestamoBundle:PrestamoProducto')->findOneById($id);
          $productoPrestamo->setDevueltoAt(new \DateTime());
          $productoPrestamo->setRecibidoBy($this->getUser());
          $producto=$productoPrestamo->getProduct();
          $producto->setAvailability(true);
          $em->persist($productoPrestamo);
          $em->persist($producto);
          $em->flush();
        }
        $em->persist($prestamo);
        $em->flush();
        $response = new JsonResponse();
        $response->setData(array(
            'id' => $request->request->get('prestamo')
        ));
        return $response;
    }

}
