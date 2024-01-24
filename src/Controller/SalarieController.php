<?php

namespace App\Controller;

use App\Repository\SalarieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SalarieController extends AbstractController
{
    #[Route('/salarie', name: 'app_salarie')]
    public function index(SalarieRepository $salarieRepository): Response
    {
        $salaries = $salarieRepository->findAll();

        return $this->render('salaries/index.html.twig', [
            'salaries' => $salaries,
        ]);
    }
}
