<?php
/**
 * Summary
 */
namespace App\Controller;

use App\Entity\IceCream;
use App\Entity\Review;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController extends Controller
{
    /**
     * Summary
     * @Route("/", name="default")
     */
    public function index()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $iceCreams = $this->getDoctrine()
            ->getRepository(IceCream::class)
            ->findAll();

        $reviews = $this->getDoctrine()
            ->getRepository(Review::class)
            ->findAll();

        return $this->render('default/index.html.twig', [
            'iceCreams' => $iceCreams,
            'user' => $user,
            'reviews' => $reviews,
        ]);
    }
}
