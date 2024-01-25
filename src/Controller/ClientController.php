<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\Client1Type;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/client/controller2')]
class ClientController extends AbstractController
{
    #[Route('/', name: 'app_client_controller2_index')]
    public function index(ClientRepository $clientRepository): Response
    {

        $clients = $clientRepository->findAll();

        return $this->render('CLient/index.html.twig', [
            'clients' => $clients,
        ]);
    }

    #[Route('/new', name: 'app_client_controller2_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $client = new Client();
        $form = $this->createForm(Client1Type::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($client);
            $entityManager->flush();

            return $this->redirectToRoute('app_client_controller2_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Client/new.html.twig', [
            'client' => $client,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_client_controller2_show', methods: ['GET'])]
    public function show(Client $client): Response
    {
        return $this->render('Client/show.html.twig', [
            'client' => $client,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_client_controller2_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Client $client, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Client1Type::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_client_controller2_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Client/edit.html.twig', [
            'client' => $client,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_client_controller2_delete', methods: ['POST'])]
    public function delete(Request $request, Client $client, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$client->getId(), $request->request->get('_token'))) {
            $entityManager->remove($client);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_client_controller2_index', [], Response::HTTP_SEE_OTHER);
    }
}
