<?php

namespace App\Controller;

use App\Entity\Lottery;
use App\Form\LotteryType;
use App\Repository\LotteryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/lottery')]
class LotteryController extends AbstractController
{
    #[Route('/', name: 'app_lottery_index', methods: ['GET'])]
    public function index(LotteryRepository $lotteryRepository): Response
    {
        return $this->render('lottery/index.html.twig', [
            'lotteries' => $lotteryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_lottery_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $lottery = new Lottery();
        $form = $this->createForm(LotteryType::class, $lottery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $lottery->setCreateDateTime(new \DateTime());
            $lottery->setState(0);

            $entityManager->persist($lottery);
            $entityManager->flush();

            return $this->redirectToRoute('app_lottery_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('lottery/new.html.twig', [
            'lottery' => $lottery,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lottery_show', methods: ['GET'])]
    public function show(Lottery $lottery): Response
    {
        return $this->render('lottery/show.html.twig', [
            'lottery' => $lottery,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_lottery_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Lottery $lottery, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LotteryType::class, $lottery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_lottery_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('lottery/edit.html.twig', [
            'lottery' => $lottery,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lottery_delete', methods: ['POST'])]
    public function delete(Request $request, Lottery $lottery, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lottery->getId(), $request->request->get('_token'))) {
            $entityManager->remove($lottery);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_lottery_index', [], Response::HTTP_SEE_OTHER);
    }
}
