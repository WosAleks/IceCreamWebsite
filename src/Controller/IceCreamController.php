<?php

namespace App\Controller;

use App\Entity\IceCream;
use App\Form\IceCreamType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
     *
     * @return Response
     */
    public function index()
    {
        $iceCreams = $this->getDoctrine()
            ->getRepository(IceCream::class)
            ->findAll();

        return $this->render('ice_cream/index.html.twig', ['iceCreams' => $iceCreams]);
    }

    /**
     * @Route("/new", name="new")
     * @Method({"GET", "POST"})
     */
    public function new(Request $request)
    {
        $iceCream = new IceCream();
        $form = $this->createForm(IceCreamType::class, $iceCream);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
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
}