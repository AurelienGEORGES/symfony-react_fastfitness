<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SeancesController extends AbstractController
{
    #[Route('/seances', name: 'app_seances')]
    public function index(): Response
    {
        return $this->render('seances/index.html.twig', [
            'controller_name' => 'SeancesController',
        ]);
    }
}
