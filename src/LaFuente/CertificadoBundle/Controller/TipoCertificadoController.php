<?php

namespace LaFuente\CertificadoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use LaFuente\CertificadoBundle\Entity\TipoCertificado;
use LaFuente\CertificadoBundle\Form\TipoCertificadoType;

/**
 * TipoCertificado controller.
 *
 */
class TipoCertificadoController extends Controller
{
    /**
     * Lists all TipoCertificado entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $tipoCertificado = new TipoCertificado();
        $form = $this->createForm("LaFuente\CertificadoBundle\Form\TipoCertificadoType", $tipoCertificado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tipoCertificado);
            $em->flush();
        }

        $tipoCertificados = $em->getRepository('LaFuenteCertificadoBundle:TipoCertificado')->findAll();
        return $this->render('LaFuenteCertificadoBundle:tipocertificado:index.html.twig', array(
            'tipoCertificados' => $tipoCertificados,
            'tipoCertificado' => $tipoCertificado,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TipoCertificado entity.
     *
     */
    public function showAction(TipoCertificado $tipoCertificado)
    {
        $deleteForm = $this->createDeleteForm($tipoCertificado);

        return $this->render('LaFuenteCertificadoBundle:tipocertificado:show.html.twig', array(
            'tipoCertificado' => $tipoCertificado,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TipoCertificado entity.
     *
     */
    public function editAction(Request $request, TipoCertificado $tipoCertificado)
    {
        $deleteForm = $this->createDeleteForm($tipoCertificado);
        $editForm = $this->createForm("LaFuente\CertificadoBundle\Form\TipoCertificadoType", $tipoCertificado);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tipoCertificado);
            $em->flush();

            return $this->redirectToRoute('tipocertificado_index');
        }

        return $this->render('LaFuenteCertificadoBundle:tipocertificado:edit.html.twig', array(
            'tipoCertificado' => $tipoCertificado,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a TipoCertificado entity.
     *
     */
    public function deleteAction(Request $request, TipoCertificado $tipoCertificado)
    {
        $form = $this->createDeleteForm($tipoCertificado);
        $form->handleRequest($request);

            $em = $this->getDoctrine()->getManager();
            $em->remove($tipoCertificado);
            $em->flush();


        return $this->redirectToRoute('tipocertificado_index');
    }

    /**
     * Creates a form to delete a TipoCertificado entity.
     *
     * @param TipoCertificado $tipoCertificado The TipoCertificado entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TipoCertificado $tipoCertificado)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipocertificado_delete', array('id' => $tipoCertificado->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
