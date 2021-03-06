<?php

namespace App\Controller;

use App\Entity\Region;
use App\Form\RegionType;
use App\Repository\RegionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/region")
 */
class RegionController extends AbstractController
{
    /**
     * @Route("/", name="back_region_index", methods={"GET"})
     */
    public function index(RegionRepository $regionRepository): Response
    {
        return $this->render('region/index.html.twig', [
            'regions' => $regionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/create", name="back_region_create", methods={"GET", "POST"})
     */
    public function new(Request $request, RegionRepository $regionRepository): Response
    {
        $region = new Region();
        $form = $this->createForm(RegionType::class, $region);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $regionRepository->add($region);

            $this->addFlash('Succés', 'Région ajoutée.');

            return $this->redirectToRoute('back_region_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('region/create.html.twig', compact('region', 'form'));
    }

    /**
     * @Route("/{id}/update", name="back_region_update", methods={"GET", "POST"})
     */
    public function edit(Request $request, Region $region, RegionRepository $regionRepository): Response
    {
        $form = $this->createForm(RegionType::class, $region);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $regionRepository->add($region);

            $this->addFlash('Succés', 'Région mise à jour.');

            return $this->redirectToRoute('back_region_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('region/update.html.twig', compact('region', 'form'));
    }

    /**
     * @Route("/{id}", name="back_region_delete", methods={"POST"})
     */
    public function delete(Request $request, Region $region, RegionRepository $regionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$region->getId(), $request->request->get('_token'))) {
            $regionRepository->remove($region);
        }

        $this->addFlash('Succés', 'Région supprimée.');

        return $this->redirectToRoute('back_region_index', [], Response::HTTP_SEE_OTHER);
    }
}
