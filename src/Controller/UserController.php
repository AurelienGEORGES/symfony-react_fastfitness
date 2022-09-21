<?php

namespace App\Controller;

use App\Repository\ReservationCoachRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ReservationDieteticienRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(ReservationCoachRepository $reservationCoachRepository, ReservationDieteticienRepository $reservationDieteticienRepository): Response
    {
        /**
         * @var App\Entity\User $user
         */
        $user = $this->getUser();

        $user_id = $user->getId();

        $reservationsCoach = $reservationCoachRepository->findByUserField($user_id);
        $reservationsDieteticien = $reservationDieteticienRepository->findByUserField($user_id);

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'user' => $user,
            'reservationsDieteticiens' => $reservationsDieteticien,
            'reservationsCoachs' => $reservationsCoach                 
        ]);
    }
   
}
