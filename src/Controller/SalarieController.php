<?php

namespace App\Controller;

use App\Entity\Salarie;
use App\Form\Salarie1Type;
use App\Repository\SalarieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/salarie/controller2')]
class SalarieController2Controller extends AbstractController
{
    #[Route('/salarie2', name: 'app_salarie_controller2_index', methods: ['GET'])]
    public function index(SalarieRepository $salarieRepository, EntityManagerInterface $entityManager): Response
    {
        $queryBuilder = $entityManager->getRepository(Salarie::class)->createQueryBuilder('s');
        $queryBuilder->select(['s.id, s.Matricule, s.Departement, s.Poste, s.Salaire, p.Nom, p.Prenom']); // Ajoutez cette ligne pour sélectionner explicitement la colonne 'id' de l'entité Personne
        $queryBuilder->leftJoin('s.personne', 'p');

        $query = $queryBuilder->getQuery();
        dump($query->getResult());

        return $this->render('Salaries/index.html.twig', [
            'salaries' => $query->getResult(),
        ]);
    }

    #[Route('/new', name: 'app_salarie_controller2_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $salarie = new Salarie();
        $form = $this->createForm(Salarie1Type::class, $salarie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($salarie);
            $entityManager->flush();

            return $this->redirectToRoute('app_salarie_controller2_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Salaries/new.html.twig', [
            'salarie' => $salarie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_salarie_controller2_show', methods: ['GET'])]
    public function show(Salarie $salarie): Response
    {
        return $this->render('Salaries/show.html.twig', [
            'salarie' => $salarie,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_salarie_controller2_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Salarie $salarie, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Salarie1Type::class, $salarie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_salarie_controller2_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Salaries/edit.html.twig', [
            'salarie' => $salarie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_salarie_controller2_delete', methods: ['POST'])]
    public function delete(Request $request, Salarie $salarie, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$salarie->getId(), $request->request->get('_token'))) {
            $entityManager->remove($salarie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_salarie_controller2_index', [], Response::HTTP_SEE_OTHER);
    }
}
