<?php

namespace Bse\CandidatureBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\Model\UserManager;
use Bse\CandidatureBundle\Entity\Candidature;
use Bse\CandidatureBundle\Entity\User as FOSUserEntity;
use Bse\CandidatureBundle\Form\CandidatureType;

use Bse\CandidatureBundle\Data\ArrayData;

/**
 * Candidature controller.
 *
 */
class CandidatureController extends Controller
{

    /**
     * Lists all Candidature entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.context')->getToken()->getUser();

        if(!$user instanceof FOSUserEntity){
            return $this->redirect($this->generateUrl('bse_candidature_welcome'));
        }

        $user = $this->get('security.context')->getToken()->getUser();

        
        $candidature = $em->getRepository('BseCandidatureBundle:Candidature')->findOneBy(array(
                'fosuserId' => $user->getId() ));
        
        $filieresChoosed = explode("//", $candidature->getFiliere());
        return $this->render('BseCandidatureBundle:Candidature:index.html.twig', array(
            'candidature' => $candidature, 'user' => $user , 'filieresChoosed' => $filieresChoosed
        ));
    }

    /**
     * Creates a new Candidature entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Candidature();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        $firstCandidature = $request->request->get('firstCandidature');

        $data = $form->getData();

        if($firstCandidature == 'first'){
            // check if email is already in use            
            $email = $form->get('email')->getData();
            $userFoundUsingEmail = $this->get('fos_user.user_manager')->findUserByEmail($email);
            if($userFoundUsingEmail != null){
                return $this->render('BseCandidatureBundle:Candidature:new.html.twig', array(
                    'entity' => $entity,            
                    'form'   => $form->createView(), 
                    'first' => 'first',
                    'emailAlreadyInUse' => $email         
                ));
            }
            // create a new user
            $userManager = $this->container->get('fos_user.user_manager');
            $user = $userManager->createUser();
            $user->setUsername($form->get('email')->getData());
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

            return $this->redirect($this->generateUrl('candidature'));
        }
        
        return $this->render('BseCandidatureBundle:Candidature:new.html.twig', array(
            'entity' => $entity,            
            'form'   => $form->createView(),            
        ));
    }

    /**
     * Creates a form to create a Candidature entity.
     *
     * @param Candidature $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Candidature $entity)
    {
        $form = $this->createForm(new CandidatureType(), $entity, array(
            'action' => $this->generateUrl('candidature_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Candidature entity.
     *
     */
    public function newAction($first)
    {
        // force going to first candidature if user is not connect and is asking a new candidature without first
        $user = $this->get('security.context')->getToken()->getUser();        
        if(!$user instanceof FOSUserEntity && $first != 'first'){
            return $this->redirect($this->generateUrl('candidature_new', array('first' => 'first')));
        }
        // force going to second candidature if user is connect and is asking a to make candidature as his first one
        if($user instanceof FOSUserEntity && $first == 'first'){ // just in case !! 
             return $this->redirect($this->generateUrl('candidature_new'));
        }        

        $entity = new Candidature();
        $form   = $this->createCreateForm($entity);

        return $this->render('BseCandidatureBundle:Candidature:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'first'  => $first
        ));
    }

    /**
     * Finds and displays a Candidature entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BseCandidatureBundle:Candidature')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Candidature entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BseCandidatureBundle:Candidature:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),            
        ));
    }

    /**
     * Displays a form to edit an existing Candidature entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BseCandidatureBundle:Candidature')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Candidature entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        $filieresChoosed = explode("//", $entity->getFiliere());

        return $this->render('BseCandidatureBundle:Candidature:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'filieresChoosed' => $filieresChoosed,
            'filieresData' => (new ArrayData())->getFilieresData(),
            'paysData' => (new ArrayData())->getPaysData(),
            'mentionsData' => (new ArrayData())->getMentionsData(),
            'etablissementsData' => (new ArrayData())->getEtablissementsData(),
            'typesDiplomeData' => (new ArrayData())->getTypesDiplomeData()
        ));
    }

    /**
    * Creates a form to edit a Candidature entity.
    *
    * @param Candidature $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Candidature $entity)
    {
        $form = $this->createForm(new CandidatureType(), $entity, array(
            'action' => $this->generateUrl('candidature_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Candidature entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BseCandidatureBundle:Candidature')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Candidature entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('candidature_edit', array('id' => $id)));
        }

        return $this->render('BseCandidatureBundle:Candidature:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Candidature entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BseCandidatureBundle:Candidature')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Candidature entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('candidature'));
    }

    /**
     * Creates a form to delete a Candidature entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('candidature_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    public function generatePdfAction(Request $request) {

        $pdfObj = $this->container->get("white_october.tcpdf")->create();

        $html = '<h1>Test custom bullet image for list items</h1>';

        $pdfObj->addPage();
        // output the HTML content
        $pdfObj->writeHTML($html);

        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

        // reset pointer to the last page
        // $pdfObj->lastPage();

        // ---------------------------------------------------------
        
        return new Response($pdfObj->Output('example_006.pdf', 'I'), 200, array(
                            'Content-Type' => 'application/pdf'));

    }
}
