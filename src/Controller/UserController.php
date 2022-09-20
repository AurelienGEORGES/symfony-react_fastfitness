<?php

namespace App\Controller;

use App\Entity\User;

use App\Entity\ReservationCoach;
use App\Entity\ReservationDieteticien;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/user/{id}', name: 'app_user', methods: ['GET'])]
    public function index( User $user, ReservationCoach $reservationCoach, ReservationDieteticien $reservationDieteticien, Request $request,): Response
    {
        $reservationCoach = new ReservationCoach();
        $reservationDieteticien = new ReservationDieteticien();

        $iduser = $request->get('id');
        $reservationCoachUser = $postrepo->findOneBy(["id" => $iduser]);

        $reservationCoach->getDateDebut();
        $reservationDieteticien->getDateDebut();

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'user' => $user,
            'reservationCoach' => $reservationCoach,
            'reservationDieteticien' => $reservationDieteticien
                       
        ]);
    }
   
}
