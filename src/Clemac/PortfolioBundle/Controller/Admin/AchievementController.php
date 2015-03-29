<?php

namespace Clemac\PortfolioBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Clemac\PortfolioBundle\Entity\Achievement;
use Clemac\PortfolioBundle\Form\AchievementType;

/**
 * Achievement controller.
 *
 * @Route("/achievement")
 */
class AchievementController extends Controller
{

    /**
     * Lists all Achievement entities.
     *
     * @Route("/", name="clemac_portfolio_admin_achievement")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ClemacPortfolioBundle:Achievement')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Achievement entity.
     *
     * @Route("/", name="clemac_portfolio_admin_achievement_create")
     * @Method("POST")
     * @Template("ClemacPortfolioBundle:Achievement:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Achievement();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('clemac_portfolio_admin_achievement_edit', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Achievement entity.
     *
     * @param Achievement $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Achievement $entity)
    {
        $form = $this->createForm(new AchievementType(), $entity, array(
            'action' => $this->generateUrl('clemac_portfolio_admin_achievement_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Achievement entity.
     *
     * @Route("/new", name="clemac_portfolio_admin_achievement_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Achievement();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Achievement entity.
     *
     * @Route("/{id}/edit", name="clemac_portfolio_admin_achievement_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ClemacPortfolioBundle:Achievement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Achievement entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Achievement entity.
    *
    * @param Achievement $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Achievement $entity)
    {
        $form = $this->createForm(new AchievementType(), $entity, array(
            'action' => $this->generateUrl('clemac_portfolio_admin_achievement_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Achievement entity.
     *
     * @Route("/{id}", name="clemac_portfolio_admin_achievement_update")
     * @Method("PUT")
     * @Template("ClemacPortfolioBundle:Achievement:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ClemacPortfolioBundle:Achievement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Achievement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('clemac_portfolio_admin_achievement_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Achievement entity.
     *
     * @Route("/{id}", name="clemac_portfolio_admin_achievement_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ClemacPortfolioBundle:Achievement')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Achievement entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('clemac_portfolio_admin_achievement'));
    }

    /**
     * Creates a form to delete a Achievement entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('clemac_portfolio_admin_achievement_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
