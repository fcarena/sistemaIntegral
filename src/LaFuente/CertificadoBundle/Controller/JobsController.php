<?php

namespace LaFuente\CertificadoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use LaFuente\CertificadoBundle\Entity\Jobs;
use LaFuente\CertificadoBundle\Form\JobsType;

/**
 * Jobs controller.
 *
 */
class JobsController extends Controller
{
    /**
     * Lists all Jobs entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $jobs = $em->getRepository('LaFuenteCertificadoBundle:Jobs')->findAll();

        return $this->render('LaFuenteCertificadoBundle:jobs:index.html.twig', array(
            'jobs' => $jobs,
        ));
    }

    /**
     * Creates a new Jobs entity.
     *
     */
    public function newAction(Request $request)
    {
        $job = new Jobs();
        $form = $this->createForm("LaFuente\CertificadoBundle\Form\JobsType", $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($job);
            $em->flush();

            return $this->redirectToRoute('jobs_index');
        }

        return $this->render('LaFuenteCertificadoBundle:jobs:new.html.twig', array(
            'job' => $job,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Jobs entity.
     *
     */
    public function showAction(Jobs $job)
    {
        $deleteForm = $this->createDeleteForm($job);

        return $this->render('LaFuenteCertificadoBundle:jobs:show.html.twig', array(
            'job' => $job,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Jobs entity.
     *
     */
    public function editAction(Request $request, Jobs $job)
    {
        $deleteForm = $this->createDeleteForm($job);
        $editForm = $this->createForm("LaFuente\CertificadoBundle\Form\JobsType", $job);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($job);
            $em->flush();

            return $this->redirectToRoute('jobs_index');
        }

        return $this->render('LaFuenteCertificadoBundle:jobs:edit.html.twig', array(
            'job' => $job,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Jobs entity.
     *
     */
    public function deleteAction(Request $request, Jobs $job)
    {
        $form = $this->createDeleteForm($job);
        $form->handleRequest($request);

            $em = $this->getDoctrine()->getManager();
            $em->remove($job);
            $em->flush();

        return $this->redirectToRoute('jobs_index');
    }

    /**
     * Creates a form to delete a Jobs entity.
     *
     * @param Jobs $job The Jobs entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Jobs $job)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('jobs_delete', array('id' => $job->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
