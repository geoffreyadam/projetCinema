<?php

namespace App\Controller;

use App\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index()
    {
        $reservations = $this->getDoctrine()->getRepository(Reservation::class)->findAll();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $allUserReservations =[];
        foreach ($reservations as $value) {
            if($value->getUser()->getId() == $user->getId())
                array_push($allUserReservations, $value);
        }

        return $this->render('dashboard/index.html.twig', [
            'userReservations' => $allUserReservations,
        ]);
    }
    /**
     * @Route("/deletereservation/{id}", name="deleteReservation")
     * @ParamConverter("id", class=Reservation::class)
     */
    public function deleteReservation($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $reservation = $this->getDoctrine()->getRepository(Reservation::class)->find($id);
        $entityManager->remove($reservation);
        $entityManager->flush();

        return $this->redirectToRoute('dashboard');
    }
    /**
     * @Route("/modifyreservation/{id}", name="modifyReservation")
     */
    public function modifyReservation($id)
    {
        $reservations = $this->getDoctrine()->getRepository(Reservation::class)->findAll();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $allUserReservations =[];
        foreach ($reservations as &$value) {
            if($value->getUser()->getId() == $user->getId())
                array_push($allUserReservations, $value);
        }

        return $this->render('dashboard/modifyReservation.html.twig', [
            'userReservations' => $allUserReservations,
        ]);
    }
}
