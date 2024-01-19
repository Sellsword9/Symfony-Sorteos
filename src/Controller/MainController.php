<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(): Response
    {
        return $this->redirectToRoute('app_lottery_index');
    }

    #[Route('/', name: 'app_main')]
    public function addMoney(): Response
    {
        return $this->redirectToRoute('addMoney.html.twig');
    }
}
