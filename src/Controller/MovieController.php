<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\Screening;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    /**
     * @Route("/allmovies", name="allMovies")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Movie::class);
        $movies = $repository->findAll();
        return $this->render('movie/allMovies.twig', [
            'movies' => $movies,
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
}
