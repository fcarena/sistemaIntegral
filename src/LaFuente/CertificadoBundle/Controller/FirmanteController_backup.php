<?php

namespace LaFuente\CertificadoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $firmantes = $em->getRepository('LaFuenteCertificadoBundle:Firmante')->findAll();

        return $this->render('LaFuenteCertificadoBundle:firmante:index.html.twig', array(
            'firmantes' => $firmantes,
        ));
    }

    /**
     * Creates a new Firmante entity.
     *
     */
    public function newAction(Request $request)
    {
        $firmante = new Firmante();
        $form = $this->createForm("LaFuente\CertificadoBundle\Form\FirmanteType", $firmante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($firmante);
            $em->flush();

            return $this->redirectToRoute('firmante_index');
        }

        return $this->render('LaFuenteCertificadoBundle:firmante:new.html.twig', array(
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
        $editForm = $this->createForm("LaFuente\CertificadoBundle\Form\FirmanteType", $firmante);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($firmante);
            $em->flush();

            return $this->redirectToRoute('firmante_index');
        }

        return $this->render('LaFuenteCertificadoBundle:firmante:edit.html.twig', array(
            'firmante' => $firmante,
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

            $em = $this->getDoctrine()->getManager();
            $em->remove($firmante);
            $em->flush();
        

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
