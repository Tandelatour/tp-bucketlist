<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main_accueil')]
    public function accueil(): Response
    {
        return $this->render('main/accueil.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
    #[Route('/apropos', name: 'main_apropos')]
    public function aPropos(): Response
    {
        return $this->render('main/aPropos.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

}
