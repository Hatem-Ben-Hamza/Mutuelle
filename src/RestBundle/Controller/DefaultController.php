<?php

namespace RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use RestBundle\Entity\Todos;
use Doctrine\DBAL\Schema\View;

class DefaultController extends Controller
{
    public function indexAction()
    {   $em = $this->getDoctrine()->getEntityManager();
        $todos = $em->getRepository('RestBundle:Todos')->findAll();
        return $this->render('RestBundle:Default:index.html.twig',array(
            'todos' => $todos
        ));
    }

    public function todosAction(){
        $em = $this->getDoctrine()->getEntityManager();
        $todos = $em->getRepository('RestBundle:Todos')->findAll();
        $serializer = $this->get('jms_serializer');
        $response = $serializer->serialize($todos,'json');
        return new Response($response);
    }

    public function createTodoAction(Request $request){
        $parametersAsArray = [];
        if ($content = $request->getContent()) {
            $parametersAsArray = json_decode($content, true);
            if(!empty($parametersAsArray[0]['name']) && !empty($parametersAsArray[0]['description'])){
                $name = $parametersAsArray[0]['name'];
                $description = $parametersAsArray[0]['description'];  
                
                $em = $this->getDoctrine()->getEntityManager();
                $todo = new Todos();
                $todo->setName($name);
                $todo->setDescription($description);
                $em->persist($todo);
                $em->flush();
                
                return new JsonResponse("User Added Successfully", Response::HTTP_OK);
            } 
            else return new JsonResponse("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE);  
        }
    }
}

