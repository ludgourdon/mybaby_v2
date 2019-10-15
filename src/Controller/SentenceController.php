<?php

namespace App\Controller;

use App\Manager\BabyManager;
use App\Manager\FamilyManager;
use App\Manager\SentenceManager;
use App\Form\SentenceType;
use App\Entity\Sentence;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * SentenceController.
 */
class SentenceController extends AbstractController
{
    /**
     * @Route("/new", name="new_sentence", requirements={"idBaby": "\d+"})
     * 
     * @param Request $request
     * @param int     $idBaby
     */
    public function newSentenceAction(Request $request, $idBaby, BabyManager $babyManager, FamilyManager $familyManager, SentenceManager $sentenceManager)
    {
        $user = $this->getUser();
        
        if ($user === null) {
            return $this->redirectToRoute('fos_user_security_login');
        }

        if (!$babyManager->hasAccessBaby($idBaby, $user)) {
            throw new \Exception('Accès interdit.');
        }

        $familyMembers = $familyManager->findByBaby($idBaby);
        $sentence = new Sentence();
        $form = $this->createForm(SentenceType::class, $sentence, array('familyMembers' => $familyMembers));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sentence = $form->getData();
            $baby = $babyManager->find($idBaby);
            $sentence->setBaby($baby);
            $sentenceManager->save($sentence);
           
            return $this->redirectToRoute('index');
        }
        
        return $this->render('MybabyMainBundle:Default:newSentence.html.twig', array(
            'form' => $form->createView(),
            'sentence' => $sentence,
        ));
    }      
}
