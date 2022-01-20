<?php

namespace App\Controller;

use App\Entity\Bookings;
use App\Entity\Room;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookingsController extends AbstractController
{
    #[Route('/bookings', name: 'bookings')]
    public function index(): Response
    {
        return $this->render('bookings/index.html.twig', [
            'controller_name' => 'BookingsController',
        ]);
    }
    #[Route('/create_booking', name: 'create_booking')]
    public function createBooking(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $booking = new Bookings();
        $booking -> setRoomrelation();
        $booking -> setUserRelation();
        $booking ->setStartDate();
        $booking ->setEndDate();

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($booking);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new booking with id '.$booking->getId());
    }
}
