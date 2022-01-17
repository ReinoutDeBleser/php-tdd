<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Room;


class BookingsController extends AbstractController
{
    #[Route('/bookings', name: 'bookings')]
    public function index(): Response
    {
        return $this->render('bookings/index.html.twig', [
            'controller_name' => 'BookingsController',
        ]);
    }

}
