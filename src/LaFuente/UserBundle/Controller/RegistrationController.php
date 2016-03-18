<?php
namespace LaFuente\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\File\UploadedFile;


use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Doctrine\UserManager;

use LaFuente\UserBundle\Entity\User;

class RegistrationController extends Controller
{

    public function indexAction()
    {
        return $this->render('UserBundle:Usuario:register.html.twig');
    }

    public function registerAction(Request $request)
    {
      try {
        $dato = $data = $request->request->all();
        $foto = $request->files->get('foto');

        $userManager = $this->container->get('fos_user.user_manager');

        $user = $userManager->createUser();
        $user->setUsername($dato['dni']);
        $user->setEmail($dato['mail']);
        $user->setPlainPassword('123456');
        $user->addRole('ROLE_USER');
        $user->setEnabled((Boolean) true);
        $user->setNombre($dato['nombre']);
        $user->setApellido($dato['apellido']);
        $user->setDni($dato['dni']);
        $user->setSexo($dato['sexo']);
        $user->setCelular($dato['telefono']);
        if(isset($foto)){
          $user->setImageBlob($foto);
        }
        $user->setCasaNro($dato['direccion_numero']);
        $user->setCalle($dato['direccion_calle']);
        $user->setCiudad($dato['direccion_ciudad']);
        $user->setCodigoPostal($dato['direccion_zip']);
        $userManager->updateUser($user);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        $estado=true;
        $msj="el usuario se registro correctamente";
      } catch (\Exception $e) {
        $msj="el usuario esta registrado";
        $estado=false;
      }
      return $this->render('UserBundle:Usuario:register.html.twig', array(
        'msj' => $msj,
        "estado" => $estado,
      ));
    }

}
