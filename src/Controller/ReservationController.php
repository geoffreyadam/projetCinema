<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Screening;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation/{id}", name="reservation")
     */
    public function index($id)
    {
        $screening = $this->getDoctrine()->getRepository(Screening::class)->find($id);
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $entityManager = $this->getDoctrine()->getManager();
        $reservation = new Reservation();
        $reservation->setUser($user);
        $reservation->setSeance($screening);
        $reservation->setCapacity(1);
        $entityManager->persist($reservation);
        $entityManager->flush();
        return $this->render('reservation/index.html.twig', ["screening" => $screening]);
    }
}