<?php
namespace App\Controller;

use App\Entity\User;
use App\Manager\BabyManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Baby;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Form\BabyType;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BabyController
 */
class BabyController extends AbstractController
{
    /**
     * @Route("/{idBaby}", name="baby", requirements={"idBaby": "\d+"})
     *
     * @param int $idBaby
     *
     * @return RedirectResponse|Response
     */
    public function babyAction($idBaby, BabyManager $babyManager)
    {
        /** @var User $user */
        $user = $this->getUser();

        if ($user === null) {
            return $this->redirectToRoute('fos_user_security_login');
        }

        if (!$babyManager->hasAccessBaby($idBaby, $user)) {
            throw new Exception('Accès interdit.');
        }

        $baby = $babyManager->find($idBaby);

        return $this->render('baby.html.twig', array('baby' => $baby));
    }

    /**
     * @Route("/new", name="new_baby")
     *
     * @param Request $request
     *
     * @return Response|RedirectResponse
     */
    public function newBabyAction(Request $request, BabyManager $babyManager)
    {
        $user = $this->getUser();

        if ($user === null) {
            return $this->redirectToRoute('fos_user_security_login');
        }

        $baby = new Baby();
        $form = $this->createForm(BabyType::class, $baby);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $baby = $form->getData();
            $baby->setUser($this->getUser());
            $babyManager->save($baby);

            return $this->redirectToRoute('index');
        }

        return $this->render('newBaby.html.twig', array(
            'form' => $form->createView(),
            'baby' => $baby,
        ));
    }

    /**
     * @Route("/edit/{idBaby}", name="edit_baby", requirements={"idBaby": "\d+"})
     *
     * @param Request     $request
     * @param int         $idBaby
     * @param BabyManager $babyManager
     *
     * @return Response|RedirectResponse
     */
    public function editBabyAction(Request $request, $idBaby, BabyManager $babyManager)
    {
        $user = $this->getUser();

        if ($user === null) {
            return $this->redirectToRoute('fos_user_security_login');
        }

        $baby = $babyManager->find($idBaby);
        $form = $this->createForm(BabyType::class, $baby);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $baby = $form->getData();
            $babyManager->save($baby);

            return $this->redirectToRoute('index');
        }

        return $this->render('newBaby.html.twig', array(
            'form' => $form->createView(),
            'baby' => $baby,
        ));
    }

    /**
     * @Route("/remove/{idBaby}", name="remove_baby", requirements={"idBaby": "\d+"})
     *
     * @param int idBaby
     *
     * @return RedirectResponse
     */
    public function removeBaby(int $id, BabyManager $babyManager)
    {
        $user = $this->getUser();

        if ($user === null) {
            return $this->redirectToRoute('fos_user_security_login');
        }

        /** @var Baby $baby */
        $baby = $babyManager->find($id);
        $babyManager->removeBaby($baby);

        return $this->redirectToRoute('index');
    }
}