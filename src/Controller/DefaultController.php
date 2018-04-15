<?php

namespace App\Controller;

use App\Entity\IceCream;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $iceCreams = $this->getDoctrine()
            ->getRepository(IceCream::class)
            ->findAll();

        return $this->render('default/index.html.twig', [
            'iceCreams' => $iceCreams,
            'user' => $user,
        ]);
    }
}
