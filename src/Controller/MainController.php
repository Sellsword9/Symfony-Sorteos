<?php

namespace App\Controller;

use App\Repository\LotteryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(LotteryRepository $lotteryRepository): Response
    {
        $this->checkLotteries($lotteryRepository);
        return $this->redirectToRoute('app_lottery_index');
    }

    #[Route('/asasdasda', name: 'app_main_add_money')]
    public function addMoney(): Response
    {
        return $this->redirectToRoute('addMoney.html.twig');
    }
    #[Route('/check', name: 'app_check')]
    public function checkLotteries(LotteryRepository $lotteryRepository)
    {
        //$lotteries = $this->getDoctrine()->getRepository(Lottery::class)->findAll();
        $lotteries = $lotteryRepository->findAll();
        foreach ($lotteries as $lottery) {
            if ($lottery->getEndDateTime() < new \DateTime()) {
                $lottery->setState(1);
                $lottery->setWinner($lottery->getTickets()[rand(0, $lottery->getStock())]);
            }
        }
    }
}
