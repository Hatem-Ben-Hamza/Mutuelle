<?php

namespace ResponsableBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ResponsableController extends Controller
{

    /**
     * @Route("/responsable/primes",name="responsableprimes")
     */
    public function PrimesAction(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->denyAccessUnlessGranted('ROLE_RESPONSABLE');
        $em = $this->getDoctrine()->getEntityManager();

        $primes = $em->getRepository('AppBundle:Prime')->findBy(array(
            'status' => 2
        ));

        return $this->render('ResponsableBundle:Responsable:primes.html.twig',array(
            'primes' => $primes
        ));
    }

    /**
     * @Route("/responsable/primes{id}/accept",name="responsableprimesAccept")
     */
    public function PrimesAcceptAction($id)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->denyAccessUnlessGranted('ROLE_RESPONSABLE');
        $em = $this->getDoctrine()->getEntityManager();

        $prime = $em->getRepository('AppBundle:Prime')->find($id);
        $prime->setStatus(1);
        $em->persist($prime);
        $em->flush();
        $this->get('session')->getFlashBag()->set('success', 'Prime accepté avec succées');

        return $this->redirect($this->generateUrl('responsableprimes'));
    }

    /**
     * @Route("/responsable/primes{id}/refuse",name="responsableprimesRefuse")
     */
    public function PrimesRefuseAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $prime = $em->getRepository('AppBundle:Prime')->find($id);
        $prime->setStatus(0);
        $em->persist($prime);
        $em->flush();
        $this->get('session')->getFlashBag()->set('success', 'Prime refusé avec succées');
        return $this->redirect($this->generateUrl('responsableprimes'));
    }

    /**
     * @Route("/responsable/primes{id}/details",name="responsableprimesDetails")
     */
    public function PrimesDetailsAction($id)
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->denyAccessUnlessGranted('ROLE_RESPONSABLE');
        $em = $this->getDoctrine()->getEntityManager();

        $prime = $em->getRepository('AppBundle:Prime')->find($id);
        return $this->render('ResponsableBundle:Responsable:detailsPrime.html.twig',array(
            'prime' => $prime
        ));
    }

    /**
     * @Route("/responsable/credits",name="responsablecredits")
     */
    public function indexAction(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->denyAccessUnlessGranted('ROLE_RESPONSABLE');
        $em = $this->getDoctrine()->getEntityManager();

        $credits = $em->getRepository('AppBundle:Credit')->findBy(array(
            'status' => 2
        ));
        return $this->render('ResponsableBundle:Responsable:credits.html.twig',array(
            'credits' => $credits
        ));
    }

    /**
     * @Route("/responsable/credits{id}/accept",name="responsablecreditsAccept")
     */
    public function CreditsAcceptAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $prime = $em->getRepository('AppBundle:Credit')->find($id);
        $prime->setStatus(1);
        $em->persist($prime);
        $em->flush();

        return $this->redirect($this->generateUrl('responsablecredits'));
    }

    /**
     * @Route("/responsable/credits{id}/refuse",name="responsablecreditsRefuse")
     */
    public function CreditsRefuseAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $credit = $em->getRepository('AppBundle:Credit')->find($id);
        $credit->setStatus(0);
        $em->persist($credit);
        $em->flush();
        return $this->redirect($this->generateUrl('responsablecredits'));
    }

    /**
     * @Route("/responsable/messages",name="responsablemessagesDetails")
     */
    public function MessagesAction()
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->denyAccessUnlessGranted('ROLE_RESPONSABLE');
        $em = $this->getDoctrine()->getEntityManager();

        $contacts = $em->getRepository('AppBundle:Contact')->findBy(array(
            'status' => 'non lus'
        ));
        return $this->render('ResponsableBundle:Responsable:contact_list.html.twig',array(
            'contacts' => $contacts
        ));
    }

    /**
     * @Route("/responsable/message{id}/delete",name="responsablemessagedelete")
     */
    public function responsablemessagedeleteAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $contact = $em->getRepository('AppBundle:Contact')->find($id);
        $em->remove($contact);
        $em->flush();
        $this->get('session')->getFlashBag()->set('success', 'Message supprimé avec succées');

        return $this->redirect($this->generateUrl('responsablemessagesDetails'));
    }

    /**
     * @Route("/responsable/message{id}/archiv",name="responsablemessagearchive")
     */
    public function responsablemessagearchiveAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $contact = $em->getRepository('AppBundle:Contact')->find($id);
        $contact->setStatus('Archivé');
        $em->persist($contact);
        $em->flush();
        $this->get('session')->getFlashBag()->set('success', 'Message archivé avec succées');

        return $this->redirect($this->generateUrl('responsablemessagesDetails'));
    }


}
