<?php

namespace LaFuente\CertificadoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;


use LaFuente\CertificadoBundle\Entity\Firmante;
use LaFuente\CertificadoBundle\Form\FirmanteType;

/**
 * Firmante controller.
 *
 */
class FirmanteController extends Controller
{
    /**
     * Lists all Firmante entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $firmante = new Firmante();
        $form = $this->createForm('LaFuente\CertificadoBundle\Form\FirmanteType', $firmante);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $foto = $request->files->get('firmante');
            $foto = $foto['firma'];
            $firmante->setFirmaBlob($foto);
            $em = $this->getDoctrine()->getManager();
            $em->persist($firmante);
            $em->flush();
        }


        $firmantes = $em->getRepository('LaFuenteCertificadoBundle:Firmante')->findAll();
        return $this->render('LaFuenteCertificadoBundle:firmante:index.html.twig', array(
            'firmantes' => $firmantes,
            'firmante' => $firmante,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Firmante entity.
     *
     */
    public function showAction(Firmante $firmante)
    {
        $deleteForm = $this->createDeleteForm($firmante);
        return $this->render('LaFuenteCertificadoBundle:firmante:show.html.twig', array(
            'firmante' => $firmante,
            'firma' => base64_encode(stream_get_contents($firmante->getFirma())),
            'type' => $firmante->getFirmaType(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Firmante entity.
     *
     */
    public function editAction(Request $request, Firmante $firmante)
    {
        $deleteForm = $this->createDeleteForm($firmante);
        $editForm = $this->createForm('LaFuente\CertificadoBundle\Form\FirmanteType', $firmante);
        //editForm->handleRequest($request);
        if ($request->getMethod() == "POST"){
            $data=$request->request->get('firmante');
            $foto = $request->files->get('firmante');
            $foto = $foto['firma'];
            $firmante->setNombre($data['nombre']);
            $firmante->setDni($data['dni']);
            $firmante->setTipoRolFirmante($data['tipoRolFirmante']);
            $firmante->removeAllJobs();
            $em = $this->getDoctrine()->getManager();
            foreach ($data['jobs'] as $job) {
                $job = $em->getRepository('LaFuenteCertificadoBundle:Jobs')->find($job);
                $firmante->addJob($job);
            }
            if (isset($foto)) {
                $firmante->setFirmaBlob($foto);
            }
            $em->persist($firmante);
            $em->flush();

            return $this->redirectToRoute('firmante_index');
        }

        return $this->render('LaFuenteCertificadoBundle:firmante:edit.html.twig', array(
            'firmante' => $firmante,
            'firma' => base64_encode(stream_get_contents($firmante->getFirma())),
            'type' => $firmante->getFirmaType(),
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Firmante entity.
     *
     */
    public function deleteAction(Request $request, Firmante $firmante)
    {
        $form = $this->createDeleteForm($firmante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($firmante);
            $em->flush();
        }

        return $this->redirectToRoute('firmante_index');
    }

    /**
     * Creates a form to delete a Firmante entity.
     *
     * @param Firmante $firmante The Firmante entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Firmante $firmante)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('firmante_delete', array('id' => $firmante->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
