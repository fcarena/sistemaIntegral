<?php

namespace LaFuente\PrestamoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use LaFuente\PrestamoBundle\Entity\Mate;
use LaFuente\PrestamoBundle\Form\MateType;

/**
 * Mate controller.
 *
 */
class MateController extends Controller
{
    /**
     * Lists all Mate entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $mate = new Mate();
        $form = $this->createForm('LaFuente\PrestamoBundle\Form\MateType', $mate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $mate->setCreatedAt((new \DateTime()));
            $em->persist($mate);
            $em->flush();
        }
        $mates = $em->getRepository('LaFuentePrestamoBundle:Mate')->findAll();

        return $this->render('LaFuentePrestamoBundle:mate:index.html.twig', array(
            'mates' => $mates,
            'mate' => $mate,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Mate entity.
     *
     */
    public function showAction(Mate $mate)
    {
        $deleteForm = $this->createDeleteForm($mate);

        return $this->render('LaFuentePrestamoBundle:mate:show.html.twig', array(
            'mate' => $mate,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Mate entity.
     *
     */
    public function editAction(Request $request, Mate $mate)
    {
        $deleteForm = $this->createDeleteForm($mate);
        $editForm = $this->createForm('LaFuente\PrestamoBundle\Form\MateType', $mate);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($mate);
            $em->flush();

            return $this->redirectToRoute('producto_mate_edit', array('id' => $mate->getId()));
        }

        return $this->render('LaFuentePrestamoBundle:mate:edit.html.twig', array(
            'mate' => $mate,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Mate entity.
     *
     */
    public function deleteAction(Request $request, Mate $mate)
    {
        $form = $this->createDeleteForm($mate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($mate);
            $em->flush();
        }

        return $this->redirectToRoute('producto_mate_index');
    }

    /**
     * Creates a form to delete a Mate entity.
     *
     * @param Mate $mate The Mate entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Mate $mate)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('producto_mate_delete', array('id' => $mate->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
