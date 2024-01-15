<?php

namespace App\Controller;

use App\Entity\Emprunt;
use App\Form\EmpruntType;
use App\Repository\EmpruntRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/emprunt')]
class EmpruntController extends AbstractController
{
    #[Route('/', name: 'app_emprunt_index', methods: ['GET'])]
    public function index(EmpruntRepository $empruntRepository,PaginatorInterface $paginator, Request $request): Response
    {

        $emprunts = $paginator->paginate(
            $empruntRepository->findBy([],['id' => 'DESC']),
            $request->query->getInt('page',1),
            2
        );

        return $this->render('emprunt/index.html.twig', [
            'emprunts' => $emprunts,
        ]);
    }

    #[Route('/new', name: 'app_emprunt_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $emprunt = new Emprunt();
        $form = $this->createForm(EmpruntType::class, $emprunt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($emprunt);
            $entityManager->flush();

            $this->addFlash('success','enregistrement éffectué avec succès');
            return $this->redirectToRoute('app_emprunt_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('emprunt/new.html.twig', [
            'emprunt' => $emprunt,
            'form' => $form,
        ]);
    }

    #[Route('/recherche', name: 'app_emprunt_date', methods: ['GET', 'POST'])]
    public function search(
        Request $request,
       EmpruntRepository $empruntRepository
    ): Response
    {
        $dateTerm  = $request->request->get('date');
        $dateimmun = new DateTimeImmutable($dateTerm);
        // dd($dateimmun);
        if ($dateTerm) {
            $emprunts = $empruntRepository->findBy(['dateemprunt'=> $dateimmun]);
            // dd($emprunts);
        } else {
            $emprunts = null;
        }

        return $this->render('emprunt/recherche_emp.html.twig', [
            'emprunts' => $emprunts,
        ]);
    }

    #[Route('/{id}', name: 'app_emprunt_show', methods: ['GET'])]
    public function show(Emprunt $emprunt): Response
    {
        return $this->render('emprunt/show.html.twig', [
            'emprunt' => $emprunt,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_emprunt_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Emprunt $emprunt, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EmpruntType::class, $emprunt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success','modification éffectué avec succès');
            return $this->redirectToRoute('app_emprunt_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('emprunt/edit.html.twig', [
            'emprunt' => $emprunt,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_emprunt_delete', methods: ['POST','GET'])]
    public function delete(Request $request, Emprunt $emprunt, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($emprunt);
        $entityManager->flush();

        $this->addFlash('error','enregistrement supprimer avec success');
        return $this->redirectToRoute('app_emprunt_index', [], Response::HTTP_SEE_OTHER);
    }
}
