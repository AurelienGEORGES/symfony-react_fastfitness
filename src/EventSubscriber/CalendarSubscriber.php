<?php

namespace App\EventSubscriber;

use CalendarBundle\Entity\Event;
use CalendarBundle\CalendarEvents;
use CalendarBundle\Event\CalendarEvent;
use App\Repository\ReservationCoachRepository;
use App\Repository\ReservationDieteticienRepository;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CalendarSubscriber implements EventSubscriberInterface
{
    private $reservationCoachRepository;
    private $reservationDieteticienRepository;
    private $router;

    public function __construct(
        ReservationCoachRepository $reservationCoachRepository,
        ReservationDieteticienRepository $reservationDieteticienRepository,
        UrlGeneratorInterface $router
    ) {
        $this->reservationCoachRepository = $reservationCoachRepository;
        $this->reservationDieteticienRepository = $reservationDieteticienRepository;
        $this->router = $router;
    }

    public static function getSubscribedEvents()
    {
        return [
            CalendarEvents::SET_DATA => 'onCalendarSetData',
        ];
    }


    public function onCalendarSetData(CalendarEvent $calendar)
    {
        $start = $calendar->getStart();
        $end = $calendar->getEnd();
        $filters = $calendar->getFilters();

        // Modify the query to fit to your entity and needs
        // Change booking.beginAt by your start date property
        // $bookings = $this->bookingRepository
        //     ->createQueryBuilder('booking')
        //     ->where('booking.beginAt BETWEEN :start and :end OR booking.endAt BETWEEN :start and :end')
        //     ->setParameter('start', $start->format('Y-m-d H:i:s'))
        //     ->setParameter('end', $end->format('Y-m-d H:i:s'))
        //     ->getQuery()
        //     ->getResult()
        // ;

        $bookings = $this->reservationCoachRepository->findAll();

        foreach ($bookings as $booking) {
            // this create the events with your data (here booking data) to fill calendar
            $bookingEvent = new Event(
                'Coaching sportif',
                $booking->getDateDebut(),    
                $booking->getDateFin() // If the end date is null or not defined, a all day event is created.
            );

            /*
             * Add custom options to events
             *
             * For more information see: https://fullcalendar.io/docs/event-object
             * and: https://github.com/fullcalendar/fullcalendar/blob/master/src/core/options.ts
             */

            $bookingEvent->setOptions([
                'backgroundColor' => 'green',
                'borderColor' => 'green',
            ]);

            // $bookingEvent->addOption(
            //     'url',
            //     $this->router->generate('app_booking_show', [
            //         'id' => $booking->getId(),
            //     ])
            // );

            // finally, add the event to the CalendarEvent to fill the calendar
            $calendar->addEvent($bookingEvent);
        }

        $bookings = $this->reservationDieteticienRepository->findAll();
        
        foreach ($bookings as $booking) {
            // this create the events with your data (here booking data) to fill calendar
            $bookingEvent = new Event(
                'Coaching diététicien',
                $booking->getDateDebut(),    
                $booking->getDateFin() // If the end date is null or not defined, a all day event is created.
            );

            /*
             * Add custom options to events
             *
             * For more information see: https://fullcalendar.io/docs/event-object
             * and: https://github.com/fullcalendar/fullcalendar/blob/master/src/core/options.ts
             */

            $bookingEvent->setOptions([
                'backgroundColor' => 'blue',
                'borderColor' => 'blue',
            ]);

            // $bookingEvent->addOption(
            //     'url',
            //     $this->router->generate('app_booking_show', [
            //         'id' => $booking->getId(),
            //     ])
            // );

            // finally, add the event to the CalendarEvent to fill the calendar
            $calendar->addEvent($bookingEvent);
        }
    }
}