<?php

namespace App\Controller;

use App\Form\EventType;
use App\Entity\Event;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EventRepository;
use Symfony\Component\Form\Extension\Core\Type\FileType;

use Symfony\Component\HttpFoundation\Request;

class EventController extends AbstractController
{
   
      /**
     * @Route("/event", name="eventall")
     */
    public function index(EventRepository $EventRepository): Response
    {
        return $this->render('event/Affiche.html.twig', [
            'Events' => $EventRepository->findAll(),
        ]);
    }

    /**
     * @Route("/event/newevent", name="event_new")
     */
    public function new(Request $request): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->add('Ajouter', SubmitType::class);
        $form->handleRequest($request);//traiter la requette recu
        
        if (($form->isSubmitted()) && ($form->isValid())) {//isvalid pour control de saisie(les entités)
            $file=$form->get('image')->getData();
            $filename=md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('images_directory'),
            $filename);
            
            $entityManager = $this->getDoctrine()->getManager();
            $event->setImage($filename);
            $entityManager->persist($event);//persist=insert into
            $entityManager->flush();

            return $this->redirectToRoute('event_show');
        }

        return $this->render('event/index.html.twig', array
           (
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/event/list", name="event_show")
     */
    public function show(EventRepository $EventRepository): Response
    {
        return $this->render('event/Affiche.html.twig', [
            'Events' => $EventRepository->eveall(),
        ]); 
    }
/**
     * @Route("/event/liste", name="event_showF")
     */
    public function showFront(EventRepository $EventRepository): Response
    {
        return $this->render('Front/index.html.twig', [
            'Events' => $EventRepository->eveall(),
        ]); 
    }
   /**
     * @Route("/{id}/eddit", name="updateevent")
     */
    public function updateevent(Request $request,$id)
    {
        $event = $this->getDoctrine()->getRepository(Event::class)->find($id);
        $form = $this->createForm(EventType::class, $event);
        $form->add('modifier',SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('event_show');
        }
        return $this->render("event/Edit.html.twig",array('form'=>$form->createView()));
    }

    /**
     * @Route("/deleteevent/{id}", name="deleteevent")
     */
    public function deleteevent($id)
    {
        $event = $this->getDoctrine()->getRepository(event::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($event);
        $em->flush();
        return $this->redirectToRoute('event_show');
    }}
