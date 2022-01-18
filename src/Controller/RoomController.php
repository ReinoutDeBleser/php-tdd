<?php

namespace App\Controller;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RoomController extends AbstractController
{

    /**
     * @throws Exception
     */
    #[Route('/', name: 'room')]
    public function index(Connection $connection): Response
    {
        $rooms = $connection->fetchAllAssociative('SELECT * FROM `php-tdd`.room ');


        return $this->render('room/index.html.twig', [
            'controller_name' => 'RoomController',
            'rooms' => $rooms,
        ]);
    }
}
