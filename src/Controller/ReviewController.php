<?php

namespace App\Controller;

/**
 * Summary
 */
use App\Entity\IceCream;
use App\Entity\Review;
use App\Form\ReviewType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/review", name="review_")
 */
class ReviewController extends Controller
{
    /**
     * @Route("/", name="index")
     * @Security("has_role('ROLE_USER')")
     * @return Response
     */
    public function index()
    {

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $reviews = $this->getDoctrine()
            ->getRepository(Review::class)
            ->findAll();

        return $this->render('review/index.html.twig', [
            'reviews' => $reviews,
            'user' => $user
        ]);
    }

    /**
     * @Route("/new", name="new")
     * @Security("has_role('ROLE_USER')")
     * @Method({"GET", "POST"})
     */
    public function new(Request $request)
    {
        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($review);
            $em->flush();

            return $this->redirectToRoute('review_edit', ['id' => $review->getId()]);
        }

        return $this->render('review/new.html.twig', [
            'review' => $review,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show")
     * @Security("has_role('ROLE_USER')")
     * @Method("GET")
     */
    public function show(Review $review)
    {
        return $this->render('review/show.html.twig', [
            'review' => $review,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit")
     * @Security("has_role('ROLE_USER')")
     * @Method({"GET", "POST"})
     */
    public function edit(Request $request, Review $review)
    {
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('review_edit', ['id' => $review->getId()]);
        }

        return $this->render('review/edit.html.twig', [
            'review' => $review,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete")
     * @Security("has_role('ROLE_USER')")
     * @Method("DELETE")
     */
    public function delete(Request $request, Review $review)
    {
        if (!$this->isCsrfTokenValid('delete'.$review->getId(), $request->request->get('_token'))) {
            return $this->redirectToRoute('review_index');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($review);
        $em->flush();

        return $this->redirectToRoute('review_index');
    }

    /**
     * @Route("/public/{id}", name="show_public")
     * @Method("GET")
     */
    public function showPublic(Review $review)
    {


        return $this->render('review/publicshow.html.twig', [
            'review' => $review,
        ]);
    }

    /**
     * @Route("/new/{icecream_id}", name="user_review")
     * @Security("has_role('ROLE_USER')")
     * @Method({"GET", "POST"})
     */
    public function userNewReview(Request $request, $icecream_id)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $icecream = $this->getDoctrine()
            ->getRepository(IceCream::class)
            ->find(['id'=>$icecream_id]);

        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $review->setUser($user);
            $review->setIcecream($icecream);

            $em->persist($review);
            $em->flush();

            return $this->redirectToRoute('review_edit', ['id' => $review->getId()]);
        }

        return $this->render('review/new.html.twig', [
            'review' => $review,
            'form' => $form->createView(),
        ]);
    }


}
