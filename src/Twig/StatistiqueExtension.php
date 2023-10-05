<?php

namespace App\Twig;

use App\Entity\Client;
use Twig\TwigFunction;
use App\Entity\Chambre;
use App\Entity\Contact;
use App\Entity\Evenement;
use App\Entity\Notification;
use App\Entity\Reservation;
use Twig\Extension\AbstractExtension;
use Doctrine\ORM\EntityManagerInterface;

class StatistiqueExtension extends AbstractExtension
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('countChambres', [$this, 'getCountChambres']),
            new TwigFunction('countChambresLibres', [$this, 'getCountChambresLibres']),
            new TwigFunction('countChambresOccupees', [$this, 'getCountChambresOccupees']),
            new TwigFunction('countClients', [$this, 'getCountClients']),
            new TwigFunction('countReservations', [$this, 'getCountReservations']),
            new TwigFunction('countNotifications', [$this, 'getCountNotifications']),
            new TwigFunction('countAllNotifications', [$this, 'getCountAllNotifications']),
            new TwigFunction('countMessages', [$this, 'getCountMessages']),
            new TwigFunction('countAllMessages', [$this, 'getCountAllMessages']),
            new TwigFunction('countAllEvent', [$this, 'getCountEvenements']),
        ];
    }

    public function getCountChambres()
    {
        return $this->entityManager->getRepository(Chambre::class)->findBy(['delete_chambre' => false]);
    }

    public function getCountChambresLibres()
    {
        return $this->entityManager->getRepository(Chambre::class)->findBy(['etat_chambre' => false, 'delete_chambre' => false]);
    }

    public function getCountChambresOccupees()
    {
        return $this->entityManager->getRepository(Chambre::class)->findBy(['etat_chambre' => true, 'delete_chambre' => false]);
    }

    public function getCountClients()
    {
        return $this->entityManager->getRepository(Client::class)->findBy(['delete_client' => false]);
    }

    public function getCountReservations()
    {
        return $this->entityManager->getRepository(Reservation::class)->findBy(['delete_reservation' => false]);
    }

    public function getCountNotifications()
    {
        return $this->entityManager->getRepository(Notification::class)->findBy(['isRead' => 0]);
    }

    public function getCountAllNotifications()
    {
        return $this->entityManager->getRepository(Notification::class)->findAll();
    }

    public function getCountMessages()
    {
        return $this->entityManager->getRepository(Contact::class)->findBy(['is_read' => 0, 'delete_message' => false]);
    }

    public function getCountAllMessages()
    {
        return $this->entityManager->getRepository(Contact::class)->findBy(['delete_message' => false]);
    }

    public function getCountEvenements()
    {
        return $this->entityManager->getRepository(Evenement::class)->findBy(['delete_event' => false]);
    }
}
