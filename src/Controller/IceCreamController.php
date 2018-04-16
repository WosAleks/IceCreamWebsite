<?php

namespace App\Controller;

use App\Entity\IceCream;
use App\Entity\Review;
use App\Form\IceCreamType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/icecream", name="ice_cream_")
 */
class IceCreamController extends Controller
{
    /**
     * @Route("/", name="index")
     * @Security("has_role('ROLE_USER')")
     * @return Response
     */
    public function index()
    {

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $iceCreams = $this->getDoctrine()
            ->getRepository(IceCream::class)
            ->findAll();

        return $this->render('ice_cream/index.html.twig', [
            'iceCreams' => $iceCreams,
            'user' => $user,
        ]);
    }

    /**
     * @Route("/new", name="new")
     * @Security("has_role('ROLE_USER')")
     * @Method({"GET", "POST"})
     */
    public function new(Request $request) // manages the new icecream button
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $iceCream = new IceCream();
        $form = $this->createForm(IceCreamType::class, $iceCream);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $iceCream->setUser($user);

            $em->persist($iceCream);
            $em->flush();

            return $this->redirectToRoute('ice_cream_edit', ['id' => $iceCream->getId()]);
        }

        return $this->render('ice_cream/new.html.twig', [
            'iceCream' => $iceCream,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show")
     * @Method("GET")
     */
    public function show(IceCream $iceCream)
    {
        return $this->render('ice_cream/show.html.twig', [
            'iceCream' => $iceCream,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit")
     * @Security("has_role('ROLE_USER')")
     * @Method({"GET", "POST"})
     */
    public function edit(Request $request, IceCream $iceCream)
    {
        $form = $this->createForm(IceCreamType::class, $iceCream);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ice_cream_edit', ['id' => $iceCream->getId()]);
        }

        return $this->render('ice_cream/edit.html.twig', [
            'iceCream' => $iceCream,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete")
     * @Security("has_role('ROLE_USER')")
     * @Method("DELETE")
     */
    public function delete(Request $request, IceCream $iceCream)
    {
        if (!$this->isCsrfTokenValid('delete'.$iceCream->getId(), $request->request->get('_token'))) {
            return $this->redirectToRoute('ice_cream_index');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($iceCream);
        $em->flush();

        return $this->redirectToRoute('ice_cream_index');
    }

    /**
     * @Route("/public/{id}", name="show_public")
     * @Method("GET")
     */
    public function showPublic(IceCream $iceCream)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $reviews = $this->getDoctrine()
            ->getRepository(Review::class)
            ->findAll();


        return $this->render('ice_cream/publicshow.html.twig', [
            'iceCream' => $iceCream,
            'reviews' => $reviews,
            'user'=> $user,
        ]);
    }
}
