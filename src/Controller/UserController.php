<?php

namespace App\Controller;

use App\Entity\ReservationCoach;
use App\Form\ReservationCoachType;
use App\Entity\ReservationDieteticien;
use App\Form\ReservationDieteticienType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ReservationCoachRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ReservationDieteticienRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(Request $request, ReservationCoachRepository $reservationCoachRepository, ReservationDieteticienRepository $reservationDieteticienRepository,ReservationCoachType $reservationCoachType, ReservationDieteticienType $reservationDieteticienType): Response
    {
        /**
         * @var App\Entity\User $user
         */
        $user = $this->getUser();

        $user_id = $user->getId();

        $reservationsCoach = new ReservationCoach();

        $formCoach = $this->createForm(ReservationCoachType::class, $reservationsCoach);
        $formCoach->handleRequest($request);

        $reservationsDieteticien = new ReservationDieteticien();

        $formDieteticien = $this->createForm(ReservationDieteticienType::class, $reservationsDieteticien);
        $formDieteticien->handleRequest($request);

        $reservationsCoach = $reservationCoachRepository->findByUserField($user_id);
        
        $reservationsCoachDates = array_map(function($reservation) {
            return [
                $reservation->getDateDebut()->format('Y-m-d') => [
                    'hour' => (int)$reservation->getDateDebut()->format('H'),
                    'minute' => 00
                ]
            ];
        }, $reservationsCoach);

        $reservationsDieteticien = $reservationDieteticienRepository->findByUserField($user_id);
        
        

        $reservationsDieteticienDates = array_map(function($reservation) {
            return [
                $reservation->getDateDebut()->format('Y-m-d') => [
                    'hour' => (int)$reservation->getDateDebut()->format('H'),
                    'minute' => 00
                ]
            ];
        }, $reservationsDieteticien);

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'user' => $user,
            'reservationsDieteticiensByUser' => $reservationsDieteticienDates,
            'reservationsCoachsByUser' => $reservationsCoachDates,
            'reservationDieteticien' => $formDieteticien->createView(),
            'reservationCoach' => $formCoach->createView()                
        ]);
    }
   
}
