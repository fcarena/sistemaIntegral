<?php

namespace LaFuente\PrestamoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use LaFuente\PrestamoBundle\Entity\Bombilla;
use LaFuente\PrestamoBundle\Form\BombillaType;

/**
 * Bombilla controller.
 *
 */
class BombillaController extends Controller
{
    /**
     * Lists all Bombilla entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $bombilla = new Bombilla();
        $form = $this->createForm('LaFuente\PrestamoBundle\Form\BombillaType', $bombilla);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $bombilla->setCreatedAt((new \DateTime()));
            $em->persist($bombilla);
            $em->flush();
        }

        $bombillas = $em->getRepository('LaFuentePrestamoBundle:Bombilla')->findAll();

        return $this->render('LaFuentePrestamoBundle:bombilla:index.html.twig', array(
            'bombillas' => $bombillas,
            'bombilla' => $bombilla,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Bombilla entity.
     *
     */
    public function showAction(Bombilla $bombilla)
    {
        $deleteForm = $this->createDeleteForm($bombilla);

        return $this->render('LaFuentePrestamoBundle:bombilla:show.html.twig', array(
            'bombilla' => $bombilla,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Bombilla entity.
     *
     */
    public function editAction(Request $request, Bombilla $bombilla)
    {
        $deleteForm = $this->createDeleteForm($bombilla);
        $editForm = $this->createForm('LaFuente\PrestamoBundle\Form\BombillaType', $bombilla);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bombilla);
            $em->flush();

            return $this->redirectToRoute('producto_bombilla_edit', array('id' => $bombilla->getId()));
        }

        return $this->render('LaFuentePrestamoBundle:bombilla:edit.html.twig', array(
            'bombilla' => $bombilla,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Bombilla entity.
     *
     */
    public function deleteAction(Request $request, Bombilla $bombilla)
    {
        $form = $this->createDeleteForm($bombilla);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bombilla);
            $em->flush();
        }

        return $this->redirectToRoute('producto_bombilla_index');
    }

    /**
     * Creates a form to delete a Bombilla entity.
     *
     * @param Bombilla $bombilla The Bombilla entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Bombilla $bombilla)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('producto_bombilla_delete', array('id' => $bombilla->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
