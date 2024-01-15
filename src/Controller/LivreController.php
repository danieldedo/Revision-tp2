<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Form\LivreType;
use App\Repository\LivreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LivreController extends AbstractController
{
    #[Route('/', name: 'app_livre_index', methods: ['GET'])]
    public function index(LivreRepository $livreRepository,PaginatorInterface $paginator, Request $request): Response
    {

        // $livres = $paginator->paginate(
        //     $livreRepository->findBy([],['id' => 'DESC']),
        //     $request->query->getInt('page',1),
        //     1
        // );
        return $this->render('livre/index.html.twig', [
            'livres' => $livreRepository->findBy([],['id' => 'DESC']),
        ]);
    }

    #[Route('/livre/new', name: 'app_livre_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $livre = new Livre();
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($livre);
            $entityManager->flush();

            $this->addFlash('success','enregistrement éffectué avec succès');
            return $this->redirectToRoute('app_livre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('livre/new.html.twig', [
            'livre' => $livre,
            'form' => $form,
        ]);
    }

    #[Route('/livre/{id}', name: 'app_livre_show', methods: ['GET'])]
    public function show(Livre $livre): Response
    {
        return $this->render('livre/show.html.twig', [
            'livre' => $livre,
        ]);
    }

    #[Route('/livre/{id}/edit', name: 'app_livre_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Livre $livre, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success','modification éffectué avec succès');
            return $this->redirectToRoute('app_livre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('livre/edit.html.twig', [
            'livre' => $livre,
            'form' => $form,
        ]);
    }

    #[Route('/livre/{id}/delete', name: 'app_livre_delete', methods: ['POST','GET'])]
    public function delete(Request $request, Livre $livre, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($livre);
        $entityManager->flush();

        $this->addFlash('error','enregistrement supprimer avec success');
        return $this->redirectToRoute('app_livre_index', [], Response::HTTP_SEE_OTHER);
    }
}
