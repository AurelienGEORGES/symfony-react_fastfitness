<?php

namespace App\Controller;

use App\Entity\ReservationCoach;
use App\Form\ReservationCoach1Type;
use App\Repository\ReservationCoachRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reservation/coach')]
class ReservationCoachController extends AbstractController
{
    #[Route('/', name: 'app_reservation_coach_index', methods: ['GET'])]
    public function index(ReservationCoachRepository $reservationCoachRepository): Response
    {
        return $this->render('reservation_coach/index.html.twig', [
            'reservation_coaches' => $reservationCoachRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_reservation_coach_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ReservationCoachRepository $reservationCoachRepository): Response
    {
        $reservationCoach = new ReservationCoach();
        $form = $this->createForm(ReservationCoach1Type::class, $reservationCoach);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reservationCoachRepository->add($reservationCoach, true);

            return $this->redirectToRoute('app_reservation_coach_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservation_coach/new.html.twig', [
            'reservation_coach' => $reservationCoach,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', requirements: ['id' => '\d+'], name: 'app_reservation_coach_show', methods: ['GET'])]
    public function show(ReservationCoach $reservationCoach): Response
    {
        return $this->render('reservation_coach/show.html.twig', [
            'reservation_coach' => $reservationCoach,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reservation_coach_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ReservationCoach $reservationCoach, ReservationCoachRepository $reservationCoachRepository): Response
    {
        $form = $this->createForm(ReservationCoach1Type::class, $reservationCoach);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reservationCoachRepository->add($reservationCoach, true);

            return $this->redirectToRoute('app_reservation_coach_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservation_coach/edit.html.twig', [
            'reservation_coach' => $reservationCoach,
            'form' => $form,
        ]);
    }

    #[Route('/calendar', name: 'app_reservation_coach_calendar', methods: ['GET'])]
    public function calendar(): Response
    {
        /**
         * @var App\Entity\User $user
         */
        $user = $this->getUser();

        return $this->render('reservation_coach/calendar.html.twig', [
            'user' => $user
        ]);
    }

    #[Route('/{id}', name: 'app_reservation_coach_delete', methods: ['POST'])]
    public function delete(Request $request, ReservationCoach $reservationCoach, ReservationCoachRepository $reservationCoachRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservationCoach->getId(), $request->request->get('_token'))) {
            $reservationCoachRepository->remove($reservationCoach, true);
        }

        return $this->redirectToRoute('app_reservation_coach_index', [], Response::HTTP_SEE_OTHER);
    }



}

