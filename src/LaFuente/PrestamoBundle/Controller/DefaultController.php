<?php

namespace LaFuente\PrestamoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use LaFuente\PrestamoBundle\Entity\Prestamo;
use LaFuente\PrestamoBundle\Entity\PrestamoProducto;
use LaFuente\PrestamoBundle\Entity\Mate;
use LaFuente\PrestamoBundle\Entity\Termo;
use LaFuente\PrestamoBundle\Entity\Pelota;
use LaFuente\PrestamoBundle\Entity\Bombilla;
use LaFuente\PrestamoBundle\Entity\Raqueta;
use Symfony\Component\Security\Core\SecurityContext;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
      $em = $this->getDoctrine();
      $msj=null;
      $status = null;
      if ($request->getMethod() == 'POST'){
        $data = $request->request->all();
        $codigo=$this->realizarPrestamos($data);
        $status=0;
        if ($codigo == 1) {
          $msj="El pedido se realizo correctamente";
          $status=1;
        }elseif ($codigo == 0 ) {
          $msj="El pedido no tiene asignado ningun Producto";
        }else{
          $msj="El pedido no se puede realizar el pedido porque el usuario no existe o porque alguno de los productos ya esta en prestamo";
        }
      }
      $alumnos = $em->getRepository('UserBundle:User')->findByLocked(0);
      $termos = $em->getRepository('LaFuentePrestamoBundle:Termo')->activos();
      $paletas = $em->getRepository('LaFuentePrestamoBundle:Raqueta')->count();
      $pelotas = $em->getRepository('LaFuentePrestamoBundle:Pelota')->count();
      $mates = $em->getRepository('LaFuentePrestamoBundle:Mate')->count();
      $bombillas = $em->getRepository('LaFuentePrestamoBundle:Bombilla')->count();
      $raquetas = $em->getRepository('LaFuentePrestamoBundle:Raqueta')->count();
      $cant = array(
        'paletas' => $paletas,
        'pelotas' => $pelotas,
        'mates' => $mates,
        'bombillas' => $bombillas,
        'raquetas' => $raquetas
      );

      $prestamosActivos=$em->getRepository('LaFuentePrestamoBundle:Prestamo')->findByEstado("Activo");
      return $this->render('LaFuentePrestamoBundle:Default:index.html.twig', array(
        'alumnos' => $alumnos,
        'termos' => $termos,
        'cant' => $cant,
        'status' => $status,
        "prestamosActivos" => $prestamosActivos,
        'msj' => $msj
      ));
    }

    public function realizarPrestamos($data)
    {
      $em = $this->getDoctrine()->getManager();
      $em->getConnection()->beginTransaction();
      try {
        $prestamo = new Prestamo();
        $prestamo->setFecha((new \DateTime()));
        $user = $this->getUser();
        $prestamo->setPrestador($user);
        $alumno = $em->getRepository('UserBundle:User')->findOneByDni($data['alumno']);
        if (!$alumno) {
          $em->getConnection()->rollback();
          return -1;
        }
        $prestamo->setUsuario($alumno);
        $prestamo->setEstado('Activo');
        $em->persist($prestamo);
        $em->flush();
        if (isset($data['producto'])) {
          foreach ($data['producto'] as $key => $valor) {
            if (empty($valor)){
              unset($data['producto'][$key]);
            }
          }
          if(! count($data['producto'])){
            return 0;
          }
          if (isset($data['producto']['termo'])) {
            $termo =  $em->getRepository('LaFuentePrestamoBundle:Termo')->findOneByNumero($data['producto']['termo']);
            if (!$termo->getAvailability()) {
              $em->getConnection()->rollback();
              return -1;
            }
            $termo->setAvailability(false);
            $em->persist($termo);
            $productoPrestamo= new PrestamoProducto();
            $productoPrestamo->setProduct($termo);
            $productoPrestamo->setPrestamo($prestamo);
            $prestamo->addProduct($productoPrestamo);
            $em->persist($productoPrestamo);
          }
          if (isset($data['producto']['mate'])) {
            $mate =  $em->getRepository('LaFuentePrestamoBundle:Mate')->findOneByAvailability(true);
            $mate->setAvailability(false);
            $em->persist($mate);
            $productoPrestamo= new PrestamoProducto();
            $productoPrestamo->setProduct($mate);
            $productoPrestamo->setPrestamo($prestamo);
            $prestamo->addProduct($productoPrestamo);
            $em->persist($productoPrestamo);
          }
          if (isset($data['producto']['bombilla'])) {
            $bombilla =  $em->getRepository('LaFuentePrestamoBundle:Bombilla')->findOneByAvailability(true);
            $bombilla->setAvailability(false);
            $em->persist($bombilla);
            $productoPrestamo= new PrestamoProducto();
            $productoPrestamo->setProduct($bombilla);
            $productoPrestamo->setPrestamo($prestamo);
            $prestamo->addProduct($productoPrestamo);
            $em->persist($productoPrestamo);
          }

          if (isset($data['producto']['paletas'])) {
            for ($i=0; $i < $data['producto']['paletas']; $i++) {
              $paleta =  $em->getRepository('LaFuentePrestamoBundle:Raqueta')->findOneByAvailability(true);
              $paleta->setAvailability(false);
              $em->persist($paleta);
              $em->flush();
              $productoPrestamo= new PrestamoProducto();
              $productoPrestamo->setProduct($paleta);
              $productoPrestamo->setPrestamo($prestamo);
              $prestamo->addProduct($productoPrestamo);
              $em->persist($productoPrestamo);
            }
          }

          if (isset($data['producto']['pelota'])) {
            $pelota =  $em->getRepository('LaFuentePrestamoBundle:Pelota')->findOneByAvailability(true);
            $pelota->setAvailability(false);
            $em->persist($pelota);
            $productoPrestamo= new PrestamoProducto();
            $productoPrestamo->setProduct($pelota);
            $productoPrestamo->setPrestamo($prestamo);
            $prestamo->addProduct($productoPrestamo);
            $em->persist($productoPrestamo);
          }
          $em->flush();
          $em->getConnection()->commit();
          return 1;
        }else{
          $em->getConnection()->rollback();
          return 0;
        }
      }catch (\Exception $e) {
        $em->getConnection()->rollback();
        return -1;
      }

    }
}
