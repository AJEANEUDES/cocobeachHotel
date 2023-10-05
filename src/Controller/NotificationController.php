<?php

namespace App\Controller;

use App\Entity\Notification;
use App\Repository\NotificationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NotificationController extends AbstractController
{
    /**
     * @Route("/notification", name="notifications.get")
     */
    public function getNotification(NotificationRepository $notificationRepository): Response
    {
        return $this->render('dashboard/notification/notification.html.twig', [
            'notifications' => $notificationRepository->findAll()
        ]);
    }

    /**
     * @Route("/notification/{id}", name="notifications.update")
     */
    public function getNotificationUpdate(Request $request, int $id): Response
    {
        $notification = $this->getDoctrine()->getRepository(Notification::class)->find($id);
        $notification->setIsRead(true);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        //$referer = $request->headers->get('referer');
        //return $this->redirect($referer);
        return $this->redirectToRoute('notifications.get');
    }
}
