<?php

namespace App\Controller;

use DateTimeImmutable;
use App\Entity\ReservationCoach;
use App\Form\ReservationCoachType;
use App\Entity\ReservationDieteticien;
use App\Form\ReservationDieteticienType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ReservationCoachRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ReservationDieteticienRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SeancesController extends AbstractController
{
    #[Route('/seances', name: 'app_seances', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $entityManager, ReservationDieteticienRepository $reservationDieteticienRepository, ReservationCoachRepository $reservationCoachRepository): Response
    
    {
        $date = new DateTimeImmutable();
        
        $reservationDieteticien = new ReservationDieteticien();
        $reservationCoach = new ReservationCoach();

        $formDieteticien = $this->createForm(ReservationDieteticienType::class, $reservationDieteticien);
        $formDieteticien->handleRequest($request);

        $formCoach = $this->createForm(ReservationCoachType::class, $reservationCoach);
        $formCoach->handleRequest($request);

        if ($formCoach->isSubmitted() && $formCoach->isValid()) {            
            $user = $this->getUser();
            $reservationCoach->setUser($user);
            $reservationCoach->setCreatedAt($date);
            $reservationCoach->setDateFin($date);
            $entityManager->persist($reservationCoach);
            $entityManager->flush();
        }

        $coachReservations = $reservationCoachRepository->findAll();
        
        $coachReservationsDates = array_map(function($reservation) {
            return [
                $reservation->getDateDebut()->format('Y-m-d') => [
                    'hour' => (int)$reservation->getDateDebut()->format('H'),
                    'minute' => 00
                ]
            ];
        }, $coachReservations);

        if ($formDieteticien->isSubmitted() && $formDieteticien->isValid()) {           
            $user = $this->getUser();
            $reservationDieteticien->setUser($user);
            $reservationDieteticien->setCreatedAt($date);
            $reservationDieteticien->setDateFin($date);
            $entityManager->persist($reservationDieteticien);
            $entityManager->flush();
        }

        $dieteticienReservations = $reservationDieteticienRepository->findAll();
        $dieteticienReservationsDates = array_map(function($reservation) {
            return [
                $reservation->getDateDebut()->format('Y-m-d') => [
                    'hour' => (int)$reservation->getDateDebut()->format('H'),
                    'minute' => 00
                ]
            ];
        }, $dieteticienReservations);     

        return $this->render('seances/index.html.twig', [
            'controller_name' => 'SeancesController',
            'reservationDieteticien' => $formDieteticien->createView(),
            'reservationCoach' => $formCoach->createView(),
            'reservationDieteticienPrises' => $dieteticienReservationsDates,
            'reservationCoachPrises' => $coachReservationsDates
        ]);
    }
}
