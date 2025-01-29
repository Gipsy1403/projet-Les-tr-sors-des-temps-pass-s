<?php

namespace App\Controller;

use App\Form\FiltreType;
use App\Repository\UmbrellaRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class FiltreController extends AbstractController
{
    #[Route('/galery', name: 'filtre')]
    public function index(UmbrellaRepository $repository, Request $request): Response
    {
        $form = $this->createForm(FiltreType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $category = $data['category'];

            if ($category) {
                $umbrella = $repository->filterCategory($category);
            } else {
                $umbrella = $repository->filterAsc();
            }
		  
        } else {
            $umbrella = $repository->findAll();
        }

        return $this->render('galery/galery.html.twig', [
            'umbrellas' => $umbrella,
            'filterform' => $form->createView(),
        ]);
    }
}



