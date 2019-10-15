<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Event;
use App\Form\EventType;

class EventController extends AbstractController
{
    /**
     * @Route("/create", name="create_event", requirements={"idBaby": "\d+"})
     * 
     * @param Request $request
     * @return type
     */
    public function createEventAction(Request $request, $idBaby)
    {
        $user = $this->getUser();
        
        if ($user === null) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        
        $babyManager = $this->get('mybaby_main.babymanager');
        
        if (!$babyManager->hasAccessBaby($idBaby, $user)) {
            throw new \Exception('Accès interdit.');
        }
        
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $event = $form->getData();
            $baby = $babyManager->find($idBaby);
            $event->setBaby($baby);
            $eventManager = $this->get('mybaby_main.eventmanager');
            $eventManager->save($event);

            return $this->redirectToRoute('event', array(
                'idBaby' => $idBaby, 
                'idEvent' => $event->getId(), 
                )
            );
        }
        
        return $this->render('MybabyMainBundle:Default:newEvent.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    /**
     * @Route("/{idEvent}", name="event", requirements={"idBaby": "\d+", "idEvent": "\d+"})
     */
    public function eventAction(Request $request, $idBaby, $idEvent)
    {
        $user = $this->getUser();
        
        if ($user === null) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        
        $babyManager = $this->get('mybaby_main.babymanager');
        
        if (!$babyManager->hasAccessBaby($idBaby, $user)) {
            throw new Exception('Accès interdit.');
        }
        
        $baby = $babyManager->find($idBaby);
        
        $eventManager = $this->get('mybaby_main.eventmanager');
        $event = $eventManager->find($idEvent);
        
        $photoManager = $this->get('mybaby_main.photomanager');
        $photos = $photoManager->findByEvent($idEvent);
        $helper = $this->container->get('vich_uploader.templating.helper.uploader_helper');
        foreach($photos as $photo) {
            $path = $helper->asset($photo, 'imageFile');
        }
        
        return $this->render('MybabyMainBundle:Default:event.html.twig', 
                array(
                    'baby' => $baby, 
                    'event' => $event,
                    'photos' => $photos
                ));
        
    }
    
//     /**
//     * @Route("", name="event_list", requirements={"idBaby": "\d+"})
//     *
//     * @param Request $request
//     * @param int     $idBaby
//     */
//    public function eventListAction(Request $request, $idBaby)
//    {
//        $user = $this->getUser();
//
//        if ($user === null) {
//            return $this->redirectToRoute('fos_user_security_login');
//        }
//
//        $babyManager = $this->get('mybaby_main.babymanager');
//
//        if (!$babyManager->hasAccessBaby($idBaby, $user)) {
//            throw new Exception('Accès interdit.');
//        }
//
//        $baby = $babyManager->find($idBaby);
//        $eventManager = $this->get('mybaby_main.eventmanager');
//        $events = $eventManager->findByBaby($idBaby);
//
//        return $this->render('MybabyMainBundle:Default:listEvents.html.twig', array('baby' => $baby, 'events' => $events));
//
//    }
}

