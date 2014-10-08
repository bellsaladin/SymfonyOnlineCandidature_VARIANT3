<?php

namespace Bse\InscriptionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\Model\UserManager;
use Bse\InscriptionBundle\Entity\Inscription;
use Bse\InscriptionBundle\Form\InscriptionType;
use Bse\InscriptionBundle\Entity\User as FOSUserEntity;


/**
 * Inscription controller.
 *
 */
class InscriptionController extends Controller
{

    /**
     * Lists all Inscription entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.context')->getToken()->getUser();

        if(!$user instanceof FOSUserEntity){
            return $this->redirect($this->generateUrl('bse_inscription_welcome'));
        }

        $user = $this->get('security.context')->getToken()->getUser();

        if($user instanceof FOSUserEntity){
            $entities = $em->getRepository('BseInscriptionBundle:Inscription')->findBy(array(
                'fosuserId' => $user->getId(),    
            ));
        }else{
            $entities = array();
        }
        return $this->render('BseInscriptionBundle:Inscription:index.html.twig', array(
            'entities' => $entities, 'user' => $user
        ));
    }

    /**
     * Creates a new Inscription entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Inscription();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        $firstInscription = $request->request->get('firstInscription');


        $data = $form->getData();

        if($firstInscription == 'first'){
            // create a new user
            $userManager = $this->container->get('fos_user.user_manager');
            $user = $userManager->createUser();
            $user->setUsername($form->get('prenom')->getData() . " " . $form->get('nom')->getData());
            $user->setEmail($form->get('email')->getData());
            $user->setPlainPassword($form->get('motDePasse')->getData());
            $user->setEnabled(true);
            $userManager->updateUser($user);
            // bind new entity to created user
            $entity->setFosuserId($user->getId());
        }else{
            // bind new entity to logged user
            $user = $this->get('security.context')->getToken()->getUser();
            $entity->setFosuserId($user->getId());
        }        

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();            
            $em->persist($entity);
            $em->flush();

            // autheticate the user 
            try {
                $this->container->get('fos_user.security.login_manager')->loginUser(
                    $this->container->getParameter('fos_user.firewall_name'),
                    $user);
            } catch (AccountStatusException $ex) {
                // We simply do not authenticate users which do not pass the user
                // checker (not enabled, expired, etc.).
            }

            return $this->redirect($this->generateUrl('inscription'));
        }
        
        return $this->render('BseInscriptionBundle:Inscription:new.html.twig', array(
            'entity' => $entity,            
            'form'   => $form->createView(),            
        ));
    }

    /**
     * Creates a form to create a Inscription entity.
     *
     * @param Inscription $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Inscription $entity)
    {
        $form = $this->createForm(new InscriptionType(), $entity, array(
            'action' => $this->generateUrl('inscription_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Inscription entity.
     *
     */
    public function newAction($first)
    {
        $entity = new Inscription();
        $form   = $this->createCreateForm($entity);

        return $this->render('BseInscriptionBundle:Inscription:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'first'  => $first
        ));
    }

    /**
     * Finds and displays a Inscription entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BseInscriptionBundle:Inscription')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Inscription entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BseInscriptionBundle:Inscription:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Inscription entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BseInscriptionBundle:Inscription')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Inscription entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BseInscriptionBundle:Inscription:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Inscription entity.
    *
    * @param Inscription $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Inscription $entity)
    {
        $form = $this->createForm(new InscriptionType(), $entity, array(
            'action' => $this->generateUrl('inscription_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Inscription entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BseInscriptionBundle:Inscription')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Inscription entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('inscription_edit', array('id' => $id)));
        }

        return $this->render('BseInscriptionBundle:Inscription:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Inscription entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BseInscriptionBundle:Inscription')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Inscription entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('inscription'));
    }

    /**
     * Creates a form to delete a Inscription entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('inscription_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
