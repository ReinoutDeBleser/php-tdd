<?php

namespace App\Controller;

use App\Entity\Room;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RoomController extends AbstractController
{
    #[Route('/', name: 'room')]
    public function index(): Response
    {
        $rooms = [];


        return $this->render('room/index.html.twig', [
            'controller_name' => 'RoomController',
            'room' => $rooms
        ]);
    }
    #[Route('/create_room', name: 'create_room')]
    public function createRoom(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $room = new Room();
        $room->setName("Black");
        $room->setOnlyForPremiumMembers(false);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($room);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new room with id '.$room->getId());
    }
    /**
     * @Route("/room/{id}", name="room_show")
     */
    public function show(ManagerRegistry $doctrine, int $id): Response
    {
        $room = $doctrine->getRepository(Room::class)->find($id);

        if (!$room) {
            throw $this->createNotFoundException(
                'No room found for id '.$id
            );
        }

        return new Response('room id: '.$room->getId().'<br>room name: '.$room->getName().'<br>  premium: '.$room->getOnlyForPremiumMembers());

        // or render a template
        // in the template, print things with {{ room.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }
    /**
     * @Route("/rooms", name="all_rooms")
     */
    public function showAll(ManagerRegistry $doctrine): Response
    {
        $rooms = $doctrine->getRepository(Room::class)->findAll();


        if (!$rooms) {
            throw $this->createNotFoundException(
                'No rooms found'
            );
        }
//        foreach ($rooms as $id => $room) {
//            return $room -> getOnlyForPremiumMembers();
//        }

        return $this->render('room/index.html.twig', [
            'rooms' => $rooms,
            'controller_name' => 'RoomController',
        ]);
    }
}
