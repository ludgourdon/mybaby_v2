<?php
namespace App\Controller;

use App\Entity\Baby;
use App\Manager\BabyManager;
use App\Manager\FamilyManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Form\FamilyType;
use App\Entity\Family;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FamilyController
 * @package App\Controller
 */
class FamilyController extends AbstractController
{
     /**
     * @Route("/new", name="new_parent", requirements={"idBaby": "\d+"})
     * 
     * @param Request $request 
     * @param int $idBaby
     * 
     * @return type
     */
    public function newParentAction(Request $request, $idBaby, BabyManager $babyManager, FamilyManager $familyManager)
    {
        $user = $this->getUser();
        
        if ($user === null) {
            return $this->redirectToRoute('login');
        }
        
        if (!$babyManager->hasAccessBaby($idBaby, $user)) {
            throw new Exception('Accès interdit.');
        }

        /** @var Baby $baby */
        $baby = $babyManager->find($idBaby);
        $family = new Family();
        $form = $this->createForm(FamilyType::class, $family, 
            array(
                'userAlreadyDefined' => $familyManager->familyUserAlreadyDefined($baby),
                ));
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $family = $form->getData();
            
            if (!$familyManager->familyUserAlreadyDefined($baby)) {
                $family->setUser($this->getUser());
            }
            
            $family->addBaby($baby);
            $familyManager->save($family);
           
            return $this->redirectToRoute('index');
        }
        
        return $this->render('newParent.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    /**
     * @Route("{idFamily}/edit", name="edit_family", requirements={"idBaby": "\d+", "idFamily": "\d+"})
     * 
     * @param Request $request
     * @param int     $idBaby
     */
    public function editFamilyAction(Request $request, $idBaby, $idFamily)
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
        $familyManager = $this->get('mybaby_main.familymanager');
        $family = $familyManager->find($idFamily);
        $form = $this->createForm(FamilyType::class, $family,
            array(
            'userAlreadyDefined' => $familyManager->familyUserAlreadyDefined($baby),
            ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $family = $form->getData();
            $familyManager->save($family);

            return $this->redirectToRoute('index');
        }
        
        return $this->render('MybabyMainBundle:Default:newParent.html.twig', array(
            'form' => $form->createView(),
            'baby' => $baby,
            'family' => $family,
        ));
    }
    
//     /**
//     * @Route("/", name="family_list", requirements={"idBaby": "\d+"})
//     *
//     * @param Request $request
//     * @param int $idBaby
//     *
//     * @return type
//     */
//    public function familyListAction($idBaby)
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
//        $familyMembers = null;
//
//        if (count($baby->getFamilies()) > 0) {
//            $familyMembers = $baby->getFamilies();
//        }
//
//        return $this->render('MybabyMainBundle:Default:listFamily.html.twig', array('baby' => $baby, 'familyMembers' => $familyMembers));
//    }
    
    /**
     * @Route("/{idFamilyMember}", name="family_member", requirements={"idBaby": "\d+", "idFamilyMember": "\d+"})
     */
    public function familyMemberAction($idBaby, $idFamilyMember)
    {
        $user = $this->getUser();
        
        if ($user === null) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        
        $babyManager = $this->get('mybaby_main.babymanager');
        
        if (!$babyManager->hasAccessBaby($idBaby, $user)) {
            throw new Exception('Accès interdit.');
        }
        
        $familyManager = $this->get('mybaby_main.familymanager');
        $familyMember = $familyManager->find($idFamilyMember);
        
        return $this->render('MybabyMainBundle:Default:familyMember.html.twig', array('idBaby' => $idBaby, 'familyMember' => $familyMember));
    }
}