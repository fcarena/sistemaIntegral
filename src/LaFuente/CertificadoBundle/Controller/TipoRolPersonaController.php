<?php

namespace LaFuente\CertificadoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use LaFuente\CertificadoBundle\Entity\TipoRolPersona;
use LaFuente\CertificadoBundle\Form\TipoRolPersonaType;

/**
 * TipoRolPersona controller.
 *
 */
class TipoRolPersonaController extends Controller
{
    /**
     * Lists all TipoRolPersona entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $tipoRolPersona = new TipoRolPersona();
        $form = $this->createForm("LaFuente\CertificadoBundle\Form\TipoRolPersonaType", $tipoRolPersona);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tipoRolPersona);
            $em->flush();
        }

        $tipoRolPersonas = $em->getRepository('LaFuenteCertificadoBundle:TipoRolPersona')->findAll();
        return $this->render('LaFuenteCertificadoBundle:tiporolpersona:index.html.twig', array(
            'tipoRolPersonas' => $tipoRolPersonas,
            'tipoRolPersona' => $tipoRolPersona,
            'form' => $form->createView(),
        ));
    }


    /**
     * Finds and displays a TipoRolPersona entity.
     *
     */
    public function showAction(TipoRolPersona $tipoRolPersona)
    {
        $deleteForm = $this->createDeleteForm($tipoRolPersona);

        return $this->render('LaFuenteCertificadoBundle:tiporolpersona:show.html.twig', array(
            'tipoRolPersona' => $tipoRolPersona,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TipoRolPersona entity.
     *
     */
    public function editAction(Request $request, TipoRolPersona $tipoRolPersona)
    {
        $deleteForm = $this->createDeleteForm($tipoRolPersona);
        $editForm = $this->createForm("LaFuente\CertificadoBundle\Form\TipoRolPersonaType", $tipoRolPersona);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tipoRolPersona);
            $em->flush();

            return $this->redirectToRoute('tiporolpersona_index');
        }

        return $this->render('LaFuenteCertificadoBundle:tiporolpersona:edit.html.twig', array(
            'tipoRolPersona' => $tipoRolPersona,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a TipoRolPersona entity.
     *
     */
    public function deleteAction(Request $request, TipoRolPersona $tipoRolPersona)
    {
        $form = $this->createDeleteForm($tipoRolPersona);
        $form->handleRequest($request);

            $em = $this->getDoctrine()->getManager();
            $em->remove($tipoRolPersona);
            $em->flush();

        return $this->redirectToRoute('tiporolpersona_index');
    }

    /**
     * Creates a form to delete a TipoRolPersona entity.
     *
     * @param TipoRolPersona $tipoRolPersona The TipoRolPersona entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TipoRolPersona $tipoRolPersona)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tiporolpersona_delete', array('id' => $tipoRolPersona->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
