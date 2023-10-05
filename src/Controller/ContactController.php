<?php

namespace App\Controller;

use App\Entity\Contact;
use Symfony\Component\Mime\Email;
use App\Repository\ContactRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/create-contact", name="contacts.create", methods="GET|POST")
     * #MailerInterface $mailer
     */
    public function createContact(Request $request, MailerInterface $mailer): Response
    {
        if ($request->isMethod('POST')) {
            $contact = new Contact();

            $contact->setNomContact($request->get('nom_complet'))
                ->setEmailContact($request->get('email_contact'))
                ->setMessageContact($request->get('message_contact'));
            //dd($contact);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            $email =  (new Email())
                ->from($contact->getEmailContact())
                ->to("contact@cocobeach-hotel.com")
                ->text($contact->getMessageContact())
                ->html(
                    $this->renderView('dashboard/contact/msg.html.twig', compact('contact')),
                    'text/html'
                );
            $mailer->send($email);

            $this->addFlash('success', "Le message a été envoyé avec succes");
        }

        return $this->redirect($request->headers->get('referer'));
    }


    /**
     * @Route("/contact", name="contacts.get")
     */
    public function getContact(ContactRepository $contactRepository): Response
    {
        return $this->render('dashboard/contact/contact.html.twig', [
            'contacts' => $contactRepository->findAll()
        ]);
    }

    /**
     * @Route("/contact-send", name="contacts.send")
     */
    public function sendContact(Request $request, MailerInterface $mailer): Response
    {
        $contact = new Contact();

        $contact->setEmailContact($request->get('recepteur'))
            ->setMessageContact($request->get('message'));

        $email =  (new Email())
            ->from("contact@cocobeach-hotel.com")
            ->to($contact->getEmailContact())
            ->text($contact->getMessageContact())
            ->html(
                $this->renderView('dashboard/contact/send.html.twig', compact('contact')),
                'text/html'
            );
        $mailer->send($email);

        $this->addFlash('success', "Le message a été envoyé avec succes");

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * @Route("/contact/{id}", name="contacts.update")
     */
    public function getContactUpdate(Request $request, int $id): Response
    {
        $contact = $this->getDoctrine()->getRepository(Contact::class)->find($id);
        $contact->setIsRead(true);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return $this->redirect($request->headers->get('referer'));
        //return $this->redirectToRoute('notifications.get');
    }


    /**
     * @Route("/delete-contact/{id}", name="contacts.delete")
     */
    public function deleteContact(int $id): Response
    {
        $contact = $this->getDoctrine()->getRepository(Contact::class)->find($id);
        $contact->setDeleteMessage(true);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        $this->addFlash('success', "Ce message a été supprime avec succes");
        return $this->redirectToRoute('contacts.create');
    }
}
