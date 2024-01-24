<?php

namespace App\Controller;

use App\Repository\FournisseurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FournisseurController extends AbstractController
{
    #[Route('/fournisseur', name: 'app_fournisseur')]
    public function index(FournisseurRepository $fournisseurRepository): Response
    {
        $fournisseurs = $fournisseurRepository->findAll();

        return $this->render('fournisseur/index.html.twig', [
            'fournisseurs' => $fournisseurs,
        ]);
    }
}
