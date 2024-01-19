<?php

namespace App\Entity;

use App\Repository\LotteryRepository;
use App\Repository\TicketRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TicketRepository::class)]
class Ticket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $number = null;

    #[ORM\ManyToOne(inversedBy: 'tickets')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'tickets')]
    private ?Lottery $lottery = null;

    public static function create_empty($number, $lottery): Ticket
    {
        $ticket = new Ticket();
        $ticket->setNumber($number);
        $ticket->setLottery($lottery);
        $ticket->setUser(null);
        return $ticket;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getLottery(): ?Lottery
    {
        return $this->lottery;
    }

    public function setLottery(?Lottery $lottery): static
    {
        $this->lottery = $lottery;

        return $this;
    }
}
