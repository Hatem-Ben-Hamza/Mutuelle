<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Entity\Prime;
use AppBundle\Entity\Contact;


class PrimeController extends Controller
{
    /**
     * @Route("/user/primes",name="userhomepage")
     */
    public function indexAction()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('UserBundle:Primes:index.html.twig');
    }

    /**
     * @Route("/demandePrime",name="demandePrime")
     */
    public function demandePrimeAction(Request $request)
    {
        $params = array();
        $content = $request->getContent();
        if (!empty($content))
        {
            $params = json_decode($content, true);
        }
        
        $em = $this->getDoctrine()->getEntityManager();
        $user = $this->getUSer();
        $user->setFirstName($params['nom']);
        $user->setLastName($params['prenom']);
        $user->setTel($params['tel']);
        $user->setGrade($params['grade']);
        $user->setCivilStatus($params['etat_civil']);
        $user->setAdress($params['adress']);
        $user->setNbChildren((int)$params['nb_children']);
        $user->setDateOfBirth(new \DateTime($params['birthdate']));

        $em->persist($user);
        $em->flush();

        $prime = new Prime();
        $prime->setType($params['type_prime']);
        $prime->setDemande($params['ckeditor']);
        $prime->setSignature($params['sign']);
        $prime->setSatisfaction((int)$params['emotionsratings-widget']);
        $prime->setStatus(2);
        $prime->setUser($user);
        $em->persist($prime);
        $em->flush();

        print_r($user);die();
    }

    /**
     * @Route("/HistoriquedemandesPrime",name="HistoriquedemandesPrime")
     */
    public function HistoriquedemandesPrimeAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $demandes = $em->getRepository('AppBundle:Prime')->findBy(array(
            'user' => $this->getUser()->getId()
        ));
        return $this->render('UserBundle:Primes:historique.html.twig',array(
            'demandes' => $demandes
        ));
    }

     /**
     * @Route("/ContactResponsable",name="ContactResponsable")
     */
    public function ContactResponsableAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
    
        $responsables = $em->getRepository('AppBundle:User')->findAll();
        if(!empty($request->request->get('subject')) && !empty($request->request->get('message'))){
            $contact = new Contact();
            $contact->setSubject($request->request->get('subject'));
            $contact->setMessage($request->request->get('message'));
            $contact->setUser($this->getUser()->getUsername());
            $contact->setResponsable($request->request->get('resp'));
            $contact->setStatus('non lus');
            $em->persist($contact);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Votre message à été bien envoyé');
            return $this->render('UserBundle:Default:contact.html.twig',array(
                'user' => $this->getUser()->getUsername(),
                'responsables' => $responsables
            ));
        }
        return $this->render('UserBundle:Default:contact.html.twig',array(
            'user' => $this->getUser()->getUsername(),
            'responsables' => $responsables
        ));
    }
}
