<?php
/**
 * Summary
 */
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class SecurityController
 * @package App\Controller
 */
class SecurityController extends Controller
{
    /**
     * summary
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * SecurityController constructor.
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * summary
     * @param Request $request
     * @param AuthenticationUtils $authUtils
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function login(Request $request, AuthenticationUtils $authUtils)
    {
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();

        $template = 'security/login.html.twig';
        $args = [
            'last_username' => $lastUsername,
            'error'         => $error,
        ];

        /*
        if(null != $lastUsername){
            $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy([
                        'username' => $lastUsername,
                    ]
                );

            $plainPassword = 'smith';
            print $this->encoder->encodePassword($user, $plainPassword);

            var_dump($user);
            die();
        }
        */


        return $this->render($template, $args);
    }
}