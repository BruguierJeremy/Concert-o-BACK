<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Form\GenreType;
use App\Repository\GenreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/genre")
 */
class GenreController extends AbstractController
{
    /**
     * @Route("/", name="back_genre_index", methods={"GET"})
     */
    public function index(GenreRepository $genreRepository): Response
    {
        return $this->render('genre/index.html.twig', [
            'genres' => $genreRepository->findAll(),
        ]);
    }

    /**
     * @Route("/create", name="back_genre_create", methods={"GET", "POST"})
     */
    public function create(Request $request, GenreRepository $genreRepository): Response
    {
        $genre = new Genre();
        $form = $this->createForm(GenreType::class, $genre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $genreRepository->add($genre);
            return $this->redirectToRoute('back_genre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('genre/create.html.twig', [
            'genre' => $genre,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/update", name="back_genre_update", methods={"GET", "POST"})
     */
    public function update(Request $request, Genre $genre, GenreRepository $genreRepository): Response
    {
        $form = $this->createForm(GenreType::class, $genre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $genreRepository->add($genre);
            return $this->redirectToRoute('back_genre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('genre/update.html.twig', [
            'genre' => $genre,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="back_genre_delete", methods={"POST"})
     */
    public function delete(Request $request, Genre $genre, GenreRepository $genreRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$genre->getId(), $request->request->get('_token'))) {
            $genreRepository->remove($genre);
        }

        return $this->redirectToRoute('back_genre_index', [], Response::HTTP_SEE_OTHER);
    }
}
