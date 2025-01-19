<?php

namespace App\Controller;

use App\Entity\Umbrella;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ViewController extends AbstractController{
    #[Route('/view/{id}', name: 'view')]
    public function index(Umbrella $umbrella): Response
    {
        return $this->render('view/view.html.twig', [
		'umbrellas' => $umbrella,
        ]);
    }
}
