<?php

namespace LaFuente\PrestamoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use LaFuente\PrestamoBundle\Entity\Termo;
use LaFuente\PrestamoBundle\Form\TermoType;

/**
 * Termo controller.
 *
 */
class TermoController extends Controller
{
    /**
     * Lists all Termo entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $termo = new Termo();
        $form = $this->createForm('LaFuente\PrestamoBundle\Form\TermoType', $termo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $termo->setCreatedAt((new \DateTime()));
            $em->persist($termo);
            $em->flush();
        }
        $termos = $em->getRepository('LaFuentePrestamoBundle:Termo')->findAll();

        return $this->render('LaFuentePrestamoBundle:termo:index.html.twig', array(
            'termos' => $termos,
            'termo' => $termo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Termo entity.
     *
     */
    public function showAction(Termo $termo)
    {
        $deleteForm = $this->createDeleteForm($termo);

        return $this->render('LaFuentePrestamoBundle:termo:show.html.twig', array(
            'termo' => $termo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Termo entity.
     *
     */
    public function editAction(Request $request, Termo $termo)
    {
        $deleteForm = $this->createDeleteForm($termo);
        $editForm = $this->createForm('LaFuente\PrestamoBundle\Form\TermoType', $termo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($termo);
            $em->flush();

            return $this->redirectToRoute('producto_termo_edit', array('id' => $termo->getId()));
        }

        return $this->render('LaFuentePrestamoBundle:termo:edit.html.twig', array(
            'termo' => $termo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Termo entity.
     *
     */
    public function deleteAction(Request $request, Termo $termo)
    {
        $form = $this->createDeleteForm($termo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($termo);
            $em->flush();
        }

        return $this->redirectToRoute('producto_termo_index');
    }

    /**
     * Creates a form to delete a Termo entity.
     *
     * @param Termo $termo The Termo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Termo $termo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('producto_termo_delete', array('id' => $termo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
