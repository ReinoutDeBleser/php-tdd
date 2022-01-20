<?php

namespace App\Controller;

use App\Entity\Room;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RoomController extends AbstractController
{
    #[Route('/room', name: 'room')]
    public function index(): Response
    {
        return $this->render('room/index.html.twig', [
            'controller_name' => 'RoomController',
        ]);
    }
    #[Route('/create_room', name: 'create_room')]
    public function createRoom(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $room = new Room();
        $room->setName("Red");
        $room->setOnlyForPremiumMembers(false);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($room);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new room with id '.$room->getId());
    }
}
