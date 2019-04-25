<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\Screening;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    /**
     * @Route("/allmovies", name="allMovies")
     */
    public function index(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Movie::class);
        $movies = $repository->findAll();
        $form = $this->createFormBuilder()
            ->add('name', TextType::class, [
                'attr' => ['class' => 'tinymce'],
            ])
            ->add('save', SubmitType::class, ['label' => 'Search'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $form->getData();
            return $this->redirectToRoute('allMoviesFilter', ["movies" => $form->getData()]);
        }
        return $this->render('movie/allMovies.twig', [
            'movies' => $movies, 'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/singleMovie/{id}", name="singleMovie")
     */
    public function singleMovie($id){
        $repository = $this->getDoctrine()->getRepository(Movie::class);
        $movie = $repository->find($id);
        $getScreenings = $this->getDoctrine()->getRepository(Screening::class)->findAll();
        $allScreenings = [];
        foreach ($getScreenings as $value){
            if($value->getMovie()->getId() == $id){
                array_push($allScreenings, $value);
            }
        }

        return $this->render('movie/singleMovie.html.twig', ["movie" => $movie, 'screenings' => $allScreenings]);
    }
    /**
     * @Route("/allmovies/filter", name="allMoviesFilter")
     */
    public function filterMovies(Request $request)
    {
        $filterName = $request->query->get('movies');
        $repository = $this->getDoctrine()->getRepository(Movie::class);
        $movies = $repository->findAll();

        $form = $this->createFormBuilder()
            ->add('name', TextType::class, [
                'attr' => ['class' => 'tinymce'],
            ])
            ->add('save', SubmitType::class, ['label' => 'Search'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $form->getData();
            return $this->redirectToRoute('allMoviesFilter', ["movies" => $form->getData()]);
        }

        $moviesFilter = [];

        foreach ($movies as $value){
            if (strpos(strtoupper($value->getTitle()), strtoupper(reset($filterName))) !== false) {
                array_push($moviesFilter, $value);
            }
        }

        return $this->render('movie/allMovies.twig', [
            'movies' => $moviesFilter, 'form' => $form->createView()
        ]);
    }
}
