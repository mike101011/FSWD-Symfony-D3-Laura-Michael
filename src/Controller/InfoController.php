<?php

namespace App\Controller;

use App\Entity\Rooms;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InfoController extends AbstractController
{
    #[Route('/info', name: 'info')]
    public function index(): Response
    {
        $rooms = $this->getDoctrine()->getRepository(Rooms::class)->findAll();
        return $this->render('info/index.html.twig', [
            'controller_name' => 'InfoController', 'rooms' => $rooms
        ]);
    }
}
