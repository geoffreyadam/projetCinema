<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\Reservation;
use App\Entity\Screening;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    /**
 * @Route("/reservation/confirm/{id}", name="reservationConfirm")
 */
    public function reservationConfirm($id)
    {
        $screening = $this->getDoctrine()->getRepository(Screening::class)->find($id);
        $movie = $screening->getMovie();
        return $this->render('reservation/index.html.twig', ["screening" => $screening, "movie" => $movie]);
    }

    /**
     * @Route("/reservation/{id}", name="reservation")
     */
    public function reservation(Screening $screening, EntityManagerInterface $entityManager)
    {
        $user = $this->getUser();
        $reservation = new Reservation();
        $reservation->setUser($user);
        $reservation->setScreening($screening);
        $reservation->setCapacity(1);
        $entityManager->persist($reservation);
        $entityManager->flush();
        return $this->redirectToRoute('dashboard');
    }

}