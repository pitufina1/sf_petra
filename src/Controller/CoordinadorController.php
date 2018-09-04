<?php

namespace App\Controller;

use App\Entity\Coordinador;
use App\Form\CoordinadorType;
use App\Repository\CoordinadorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/coordinador")
 */
class CoordinadorController extends AbstractController
{
    /**
     * @Route("/", name="coordinador_index", methods="GET")
     */
    public function index(CoordinadorRepository $coordinadorRepository): Response
    {
        return $this->render('coordinador/index.html.twig', ['coordinadors' => $coordinadorRepository->findAll()]);
    }

    /**
     * @Route("/new", name="coordinador_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $coordinador = new Coordinador();
        $form = $this->createForm(CoordinadorType::class, $coordinador);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($coordinador);
            $em->flush();

            return $this->redirectToRoute('coordinador_index');
        }

        return $this->render('coordinador/new.html.twig', [
            'coordinador' => $coordinador,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="coordinador_show", methods="GET")
     */
    public function show(Coordinador $coordinador): Response
    {
        return $this->render('coordinador/show.html.twig', ['coordinador' => $coordinador]);
    }

    /**
     * @Route("/{id}/edit", name="coordinador_edit", methods="GET|POST")
     */
    public function edit(Request $request, Coordinador $coordinador): Response
    {
        $form = $this->createForm(CoordinadorType::class, $coordinador);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('coordinador_edit', ['id' => $coordinador->getId()]);
        }

        return $this->render('coordinador/edit.html.twig', [
            'coordinador' => $coordinador,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="coordinador_delete", methods="DELETE")
     */
    public function delete(Request $request, Coordinador $coordinador): Response
    {
        if ($this->isCsrfTokenValid('delete'.$coordinador->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($coordinador);
            $em->flush();
        }

        return $this->redirectToRoute('coordinador_index');
    }
}
