<?php

namespace App\Controller;

use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RoomController extends AbstractController
{
    #[Route('/', name: 'room')]
    public function index(Connection $connection): Response
    {
        $rooms = 'room';


        //probably  an array of strings over which to loop

        return $this->render('room/index.html.twig', [
            'controller_name' => 'RoomController',
            'rooms' => $rooms,
            //links => an array of links related to a search in the database of an array of arrays.
            // maybe just fetch an array of objects and loop over both, and display the different ones
        ]);
    }
}
