<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Entity\Prime;
use AppBundle\Entity\Credit;



class CreditController extends Controller
{
    /**
     * @Route("/user/credits",name="usercredits")
     */
    public function credtisAction()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('UserBundle:Credits:index.html.twig');
    }

     /**
     * @Route("/demandeCredit",name="demandeCredit")
     */
    public function demandePrimeAction(Request $request)
    {
        $params = array();
        $content = $request->getContent();
        if (!empty($content))
        {
            $params = json_decode($content, true);
        }
        //print_r($params);die();

        $em = $this->getDoctrine()->getEntityManager();
        $user = $this->getUSer();
        $user->setFirstName($params['nom']);
        $user->setLastName($params['prenom']);
        $user->setTel($params['tel']);
        $user->setAdress($params['adress']);
        $user->setDateOfBirth(new \DateTime($params['birthdate']));

        $em->persist($user);
        $em->flush();

        $credit = new Credit();
        $credit->setObjet($params['objet_credit']);
        $credit->setMantant((int)$params['Mantant Solicité']);
        $credit->setDuree((int)$params['Durée de remboursement']);
        $credit->setCommentaire($params['commentaire']);
        $credit->setNumCompte($params['num_compte']);
        $credit->setBanque($params['banque']);
        $credit->setAgence($params['agence']);
        $credit->setStatus(2);
        $credit->setUser($user);
        $em->persist($credit);
        $em->flush();

        print_r($user);die();
    }

    /**
     * @Route("/Historiquecredits",name="Historiquecredits")
     */
    public function HistoriquecreditsAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $credits = $em->getRepository('AppBundle:Credit')->findBy(array(
            'user' => $this->getUser()->getId()
        ));

        return $this->render('UserBundle:Credits:historique.html.twig',array(
            'credits' => $credits
        ));
    }
}
