<?php

namespace App\Controller;

use App\Repository\LotteryRepository;
use DateTime;
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

    public function checkLotteries(LotteryRepository $lotteryRepository, EntityManager $entityManager)
    {
        $lotteries = $lotteryRepository->findFinished();
        //dd($lotteries);
        foreach ($lotteries as $lottery) {
            $lottery->setState(1);
            $lottery->setWinner($lottery->getTickets()[rand(0, $lottery->getStock())]);
        }
        $entityManager->flush();
    }
}
