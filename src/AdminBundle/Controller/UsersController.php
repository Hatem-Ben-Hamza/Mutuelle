<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class UsersController extends Controller
{
    /**
     * @Route("/users",name="list_users")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        /*$employes = $em->getRepository('AppBundle:User')->findBy(array(
            'grade' => 'employe'
        ));*/
        /*$responsables = $em->getRepository('AppBundle:User')->findBy(array(
            'grade' => 'responsable'
        ));*/

        $query = $this->getDoctrine()->getEntityManager()
                       ->createQuery(
                              'SELECT u FROM AppBundle:User u WHERE u.roles LIKE :role'
                        )->setParameter('role', '%"ROLE_RESPONSABLE"%'
                );
        $responsables = $query->getResult();

        $query2 = $this->getDoctrine()->getEntityManager()
                       ->createQuery(
                              'SELECT u FROM AppBundle:User u WHERE u.roles NOT LIKE :role'
                        )->setParameter('role', '%"ROLE_RESPONSABLE"%'
                );
        $employes = $query2->getResult();


        return $this->render('AdminBundle:Users:index.html.twig',array(
            'employes' => $employes,
            'responsables' => $responsables
        ));
    }

     /**
     * @Route("/users/add")
     */
    public function addAction(Request $request){
        $em = $this->getDoctrine()->getEntityManager();
        $user = new User();
        $form = $this->createForm(UserType::class,$user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl('list_users'));
        }

        return $this->render('AdminBundle:Users:create.html.twig',array(
            'form' => $form->createView()
        )); 
    }

    /**
     * @Route("/users/showList")
     */
    public function showAction(){
        $em = $this->getDoctrine()->getEntityManager();
        $users = $em->getRepository('AppBundle:User')->findAll();
        return $this->render('AdminBundle:Users:edit.html.twig',array(
            'users' => $users,
        ));
    }

    /**
     * @Route("/users/edit/{id}")
     */
    public function editAction(Request $request,$id){
        $em = $this->getDoctrine()->getEntityManager();
        $user =  $responsables = $em->getRepository('AppBundle:User')->find($id);
        $form = $this->createFormBuilder($user)
        ->add('firstName',TextType::class)
        ->add('lastName',TextType::class)
        ->add('tel',TextType::class)
        ->add('grade',ChoiceType::class,array('choices'=>array(
            'Employe' => 'employe',
            'Responsable' => 'responsable'
        )))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl('list_users'));
        }

        return $this->render('AdminBundle:Users:edit2.html.twig',array(
            'form' => $form->createView()
        )); 
    }
}
