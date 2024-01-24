<?php

namespace App\Controller;

use App\Repository\AchatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AchatController extends AbstractController
{
    #[Route('/achat', name: 'app_achat')]
    public function index(AchatRepository $achatsRepository): Response
    {
        $achats = $achatsRepository->findAll();

        return $this->render('achat/index.html.twig', [
            'achats' => $achats,
        ]);
    }
}
