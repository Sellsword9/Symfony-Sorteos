<?php

namespace App\Controller;

use App\Repository\LotteryRepository;
use Doctrine\ORM\EntityManagerInterface as EntityManager;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(LotteryRepository $lotteryRepository, EntityManager $entityManager): Response
    {
        $this->checkLotteries($lotteryRepository, $entityManager);
        return $this->redirectToRoute('app_lottery_index');
    }

    #[Route('/check', name: 'app_check')]
    public function checkLotteries(LotteryRepository $lotteryRepository, EntityManager $entityManager)
    {
        $lotteries = $lotteryRepository->findAll();
        foreach ($lotteries as $lottery) {
            if ($lottery->getEndDateTime() < new \DateTime()) {
                $lottery->setState(1);
                $lottery->setWinner($lottery->getTickets()[rand(0, $lottery->getStock())]);
            }
        }
        $entityManager->flush();
    }
}
