<?php

namespace LaFuente\PrestamoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use LaFuente\PrestamoBundle\Entity\Raqueta;
use LaFuente\PrestamoBundle\Form\RaquetaType;

/**
 * Raqueta controller.
 *
 */
class RaquetaController extends Controller
{
    /**
     * Lists all Raqueta entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $raquetum = new Raqueta();
        $form = $this->createForm('LaFuente\PrestamoBundle\Form\RaquetaType', $raquetum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $raquetum->setCreatedAt((new \DateTime()));
            $em->persist($raquetum);
            $em->flush();
        }
        $raquetas = $em->getRepository('LaFuentePrestamoBundle:Raqueta')->findAll();

        return $this->render('LaFuentePrestamoBundle:raqueta:index.html.twig', array(
            'raquetas' => $raquetas,
            'raquetum' => $raquetum,
            'form' => $form->createView(),
        ));
    }


    /**
     * Finds and displays a Raqueta entity.
     *
     */
    public function showAction(Raqueta $raquetum)
    {
        $deleteForm = $this->createDeleteForm($raquetum);

        return $this->render('LaFuentePrestamoBundle:raqueta:show.html.twig', array(
            'raquetum' => $raquetum,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Raqueta entity.
     *
     */
    public function editAction(Request $request, Raqueta $raquetum)
    {
        $deleteForm = $this->createDeleteForm($raquetum);
        $editForm = $this->createForm('LaFuente\PrestamoBundle\Form\RaquetaType', $raquetum);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($raquetum);
            $em->flush();

            return $this->redirectToRoute('producto_raqueta_edit', array('id' => $raquetum->getId()));
        }

        return $this->render('LaFuentePrestamoBundle:raqueta:edit.html.twig', array(
            'raquetum' => $raquetum,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Raqueta entity.
     *
     */
    public function deleteAction(Request $request, Raqueta $raquetum)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($raquetum);
        $em->flush();
        return $this->redirectToRoute('producto_raqueta_index');
    }

    /**
     * Creates a form to delete a Raqueta entity.
     *
     * @param Raqueta $raquetum The Raqueta entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Raqueta $raquetum)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('producto_raqueta_delete', array('id' => $raquetum->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
