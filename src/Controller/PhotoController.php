<?php
namespace App\Controller;

use App\Entity\Baby;
use App\Manager\BabyManager;
use App\Manager\PhotoManager;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Photo;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;

class PhotoController extends AbstractController
{
    /**
     * @Route("event/{idEvent}/upload", name="upload_photo_event", requirements={"idBaby": "\d+", "idEvent": "\d+"})
     * 
     * @param int $idBaby 
     * @param int $idEvent
     */
    public function uploadPhotoEventAction($idBaby, $idEvent)
    {
        $user = $this->getUser();
        
        if ($user === null) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        
        $babyManager = $this->get('mybaby_main.babymanager');
        $baby = $babyManager->find($idBaby);
        
        $eventManager = $this->get('mybaby_main.eventmanager');
        $event = $eventManager->find($idEvent);
        
        return $this->render('MybabyMainBundle:Default:uploadPhotoEvent.html.twig', array('baby' => $baby, 'event' => $event));
    }
    
    /**
     * @Route("/upload", name="upload_photo_baby", requirements={"idBaby": "\d+"})
     * 
     * @param int $idBaby 
     */
    public function uploadPhotoBabyAction($idBaby)
    {
        $user = $this->getUser();
        
        if ($user === null) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        
        $babyManager = $this->get('mybaby_main.babymanager');
        $baby = $babyManager->find($idBaby);
        
        return $this->render('MybabyMainBundle:Default:uploadPhotoBaby.html.twig', array('baby' => $baby));
    }
    
        /**
     * @Route("/upload", name="upload_photo_baby", requirements={"idBaby": "\d+", "idFamily": "\d+"})
     * 
     * @param int $idBaby 
     */
    public function uploadPhotoFamilyAction($idBaby, $idFamily)
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
        
        $family = $familyManager->find($idFamily);
        
        return $this->render('MybabyMainBundle:Default:uploadPhotoFamily.html.twig', array('family' => $family));
    }
    
    /**
     * @Route("/", name="photos")
     * 
     * @param Request $request
     */
    public function photosAction(Request $request, $idBaby, $idEvent)
    {
        $user = $this->getUser();
        
        if ($user === null) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        
        $photoManager = $this->get('mybaby_main.photomanager');
        $photos = $photoManager->findByEvent($idEvent);
        $helper = $this->container->get('vich_uploader.templating.helper.uploader_helper');
        foreach($photos as $photo) {
            $path = $helper->asset($photo, 'imageFile');
        }
        
        return $this->render('MybabyMainBundle:Default:photos.html.twig', array(
            'photos' => $photos
        ));
    }

    /**
     * @Route("/ajax/image/send-profile/baby/{idBaby}", name="ajax_image_send_profile_baby", requirements={"idBaby": "\d+"})
     *
     * @param Request $request
     * @param $idBaby
     * @param BabyManager $babyManager
     * @param PhotoManager $photoManager
     * @return JsonResponse
     * @throws \Exception
     */
    public function ajaxImageSendProfileBabyAction(Request $request, $idBaby, BabyManager $babyManager, PhotoManager $photoManager)
    {
        /** @var File $media */
        $media = $request->files->get('file');
        $this->addImageBaby($media, $idBaby, $babyManager, $photoManager, true);

        return new JsonResponse(array('success' => true));
    }

    /**
     * @Route("/ajax/image/send/baby/{idBaby}", name="ajax_image_send_baby", requirements={"idBaby": "\d+"})
     *
     * @param Request $request
     * @param int $idBaby
     * @param BabyManager $babyManager
     * @param PhotoManager $photoManager
     * @return JsonResponse
     *
     * @throws \Exception
     */
    public function ajaxImageSendBabyAction(Request $request, $idBaby, BabyManager $babyManager, PhotoManager $photoManager)
    {
        /** @var File $media */
        $media = $request->files->get('file');
        $this->addImageBaby($media, $idBaby, $babyManager, $photoManager);

        return new JsonResponse(array('success' => true));
    }

    /**
     * @param File $media
     * @param $idBaby
     * @param BabyManager $babyManager
     * @param PhotoManager $photoManager
     *
     * @throws \Exception
     */
    private function addImageBaby(File $media, $idBaby, BabyManager $babyManager,  PhotoManager $photoManager, $isProfile = false)
    {
        try {
            $photo = new Photo();
            $photo->setImageFile($media);
            $photo->setPath($media->getPathName());
            $photo->setImage($media->getClientOriginalName());
            $photo->setImageSize($media->getSize());
            $photo->setProfilePicture($isProfile);

            /** @var Baby $baby */
            $baby = $babyManager->find($idBaby);
            $photo->setBaby($baby);
            $photoManager->save($photo);
        } catch(Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }
    
    /**
     * @Route("event/{idEvent}/ajax/image/send", name="ajax_image_send_event", requirements={"idBaby": "\d+", "idEvent": "\d+"})
     * 
     * @param Request $request
     * @param int $idBaby 
     * @param int $idEvent
     *
     * @return JsonResponse
     */
    public function ajaxImageSendEventAction(Request $request, $idBaby, $idEvent)
    {
        /** @var File $media */
        $media = $request->files->get('file');
        $photo = new Photo();
        $photo->setImageFile($media);
        $photo->setPath($media->getPathName());
        $photo->setImage($media->getClientOriginalName());
        $photo->setImageSize($media->getSize());
        $eventManager = $this->get('mybaby_main.eventmanager');
        $event = $eventManager->find($idEvent);
        $photo->setEvent($event);

        $photoManager = $this->get('mybaby_main.photomanager');
        $photoManager->save($photo);

        return new JsonResponse(array('success' => true));
    }
    
    /**
     * @Route("family/{idFamily}/ajax/image/send", name="ajax_image_send_family", requirements={"idBaby": "\d+", "idFamily": "\d+"})
     * 
     * @param Request $request 
     * @param int $idFamily
     *
     * @return JsonResponse
     *
     * @throws \Exception
     */
    public function ajaxImageSendFamilyAction(Request $request, $idBaby, $idFamily)
    {
        /** @var File $media */
        $media = $request->files->get('file');
        $photo = new Photo();
        $photo->setImageFile($media);
        $photo->setPath($media->getPathName());
        $photo->setImage($media->getClientOriginalName());
        $photo->setImageSize($media->getSize());
        $familyManager = $this->get('mybaby_main.familymanager');
        $family = $familyManager->find($idFamily);
        $photo->setFamily($family);

        $photoManager = $this->get('mybaby_main.photomanager');
        $photoManager->save($photo);

        return new JsonResponse(array('success' => true));
    }
}
