<?php

namespace LaFuente\PrestamoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use LaFuente\PrestamoBundle\Entity\Pelota;
use LaFuente\PrestamoBundle\Form\PelotaType;

/**
 * Pelota controller.
 *
 */
class PelotaController extends Controller
{
    /**
     * Lists all Pelota entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $pelotum = new Pelota();
        $form = $this->createForm('LaFuente\PrestamoBundle\Form\PelotaType', $pelotum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $pelotum->setCreatedAt((new \DateTime()));
            $em->persist($pelotum);
            $em->flush();
        }

        $pelotas = $em->getRepository('LaFuentePrestamoBundle:Pelota')->findAll();

        return $this->render('LaFuentePrestamoBundle:pelota:index.html.twig', array(
            'pelotas' => $pelotas,
            'pelotum' => $pelotum,
            'form' => $form->createView(),
        ));
    }


    /**
     * Finds and displays a Pelota entity.
     *
     */
    public function showAction(Pelota $pelotum)
    {
        $deleteForm = $this->createDeleteForm($pelotum);

        return $this->render('LaFuentePrestamoBundle:pelota:show.html.twig', array(
            'pelotum' => $pelotum,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Pelota entity.
     *
     */
    public function editAction(Request $request, Pelota $pelotum)
    {
        $deleteForm = $this->createDeleteForm($pelotum);
        $editForm = $this->createForm('LaFuente\PrestamoBundle\Form\PelotaType', $pelotum);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pelotum);
            $em->flush();

            return $this->redirectToRoute('producto_pelota_edit', array('id' => $pelotum->getId()));
        }

        return $this->render('LaFuentePrestamoBundle:pelota:edit.html.twig', array(
            'pelotum' => $pelotum,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Pelota entity.
     *
     */
    public function deleteAction(Request $request, Pelota $pelotum)
    {
        $form = $this->createDeleteForm($pelotum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pelotum);
            $em->flush();
        }

        return $this->redirectToRoute('producto_pelota_index');
    }

    /**
     * Creates a form to delete a Pelota entity.
     *
     * @param Pelota $pelotum The Pelota entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pelota $pelotum)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('producto_pelota_delete', array('id' => $pelotum->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
