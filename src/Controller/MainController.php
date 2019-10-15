<?php
namespace App\Controller;

use App\Entity\Baby;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MainController
 */
class MainController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction()
    {
        $user = null;

        if ($user === null) {
            return $this->render('newUser.html.twig');
        }
        
//        $babies = $user->getBabies();
//        if ($babies->isEmpty()) {
//            return $this->redirectToRoute('new_baby');
//        }
//
//        if ($babies->count() > 1) {
//            return $this->render('myBabies.html.twig', array('babies' => $babies));
//        }
//
//        /** @var Baby $baby */
//        $baby = $babies->first();
//
//        $sentences = $baby->getSentences();
//        $sentences->count();
//
//        return $this->render('index.html.twig', array('baby' => $babies->first()));
    }
}
