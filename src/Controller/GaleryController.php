<?php

namespace App\Controller;

use App\Repository\UmbrellaRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class GaleryController extends AbstractController{
    #[Route('/galery', name: 'galery')]
    public function index(UmbrellaRepository $repository): Response
    {
	$umbrella=$repository->findAll();
        return $this->render('galery/galery.html.twig', [
            'umbrellas' => $umbrella,
        ]);
    }
}
