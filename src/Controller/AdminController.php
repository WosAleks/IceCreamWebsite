<?php
/**
 * Summary
 */
namespace App\Controller;

/**
 * Entities
 */

use App\Entity\IceCream;
use App\Entity\Review;
use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class AdminController
 * @package App\Controller
 */
class AdminController extends Controller
{
    /**
     * summary
     * @Route("/admin", name="admin")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function index()
    {

        $reviews = $this->getDoctrine() //gets reviews
            ->getRepository(Review::class)
            ->findAll();
        $icecreams = $this->getDoctrine()
            ->getRepository(IceCream::class)
            ->findAll();
        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        return $this->render('admin/index.html.twig', [ //displays everything it gets
            'reviews'=>$reviews,
            'icecreams'=> $icecreams,
            'users'=>$users,
        ]);
    }
}
