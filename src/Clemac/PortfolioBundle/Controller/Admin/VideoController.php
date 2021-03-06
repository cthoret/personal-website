<?php

namespace Clemac\PortfolioBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Clemac\PortfolioBundle\Entity\Video;
use Clemac\PortfolioBundle\Form\VideoType;

/**
 * Video controller.
 *
 * @Route("/video")
 */
class VideoController extends Controller
{

    /**
     * Lists all Video entities.
     *
     * @Route("/", name="clemac_portfolio_admin_video")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ClemacPortfolioBundle:Video')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Video entity.
     *
     * @Route("/", name="clemac_portfolio_admin_video_create")
     * @Method("POST")
     * @Template("ClemacPortfolioBundle:Admin/Video:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Video();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $newFilename = 'archievement-' . rand(1, 99999) . '-' . $form['image']->getData()->getClientOriginalName();

            $form['image']->getData()->move($this->get('kernel')->getRootDir() . '/../web/' . $this->container->getParameter('upload_path'), $newFilename);

            $entity->setImage($newFilename);

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('clemac_portfolio_admin_video_edit', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Video entity.
     *
     * @param Video $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Video $entity)
    {
        $form = $this->createForm(new VideoType(), $entity, array(
            'action' => $this->generateUrl('clemac_portfolio_admin_video_create'),
            'method' => 'POST',
        ));

        $form->add('image', 'file')
             ->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Video entity.
     *
     * @Route("/new", name="clemac_portfolio_admin_video_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Video();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Video entity.
     *
     * @Route("/{id}/edit", name="clemac_portfolio_admin_video_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ClemacPortfolioBundle:Video')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Video entity.');
        }

        // remove old uplodImage
        $oldImage = $entity->getImage();
        $entity->setImage(null);

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        $entity->setImage($oldImage);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Video entity.
    *
    * @param Video $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Video $entity)
    {
        $form = $this->createForm(new VideoType(), $entity, array(
            'action' => $this->generateUrl('clemac_portfolio_admin_video_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('image', 'file', array('required'    => false))
             ->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Video entity.
     *
     * @Route("/{id}", name="clemac_portfolio_admin_video_update")
     * @Method("PUT")
     * @Template("ClemacPortfolioBundle:Admin/Video:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ClemacPortfolioBundle:Video')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Video entity.');
        }

        // remove old uplodImage
        $oldImage = $entity->getImage();
        $entity->setImage(null);

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        $entity->setImage($oldImage);

        if ($editForm->isValid()) {
            if ($editForm['image']->getData() != null) {
                $newFilename = 'archievement-' . rand(1, 99999) . '-' . $editForm['image']->getData()->getClientOriginalName();

                $editForm['image']->getData()->move($this->get('kernel')->getRootDir() . '/../web/' . $this->container->getParameter('upload_path'), $newFilename);

                $entity->setImage($newFilename);
            }
            $em->flush();

            return $this->redirect($this->generateUrl('clemac_portfolio_admin_video_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Video entity.
     *
     * @Route("/{id}", name="clemac_portfolio_admin_video_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ClemacPortfolioBundle:Video')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Video entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('clemac_portfolio_admin_video'));
    }

    /**
     * Creates a form to delete a Video entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('clemac_portfolio_admin_video_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
