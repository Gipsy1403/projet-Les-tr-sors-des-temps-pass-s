<?php

namespace App\Controller;

use App\Entity\Umbrella;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ViewController extends AbstractController
{
    #[Route('/view/{id}', name: 'view')]
    public function viewUmbrella(Umbrella $umbrella): Response
    {


        // Retourne le template Twig avec la variable
        return $this->render('view/view.html.twig', [
            'umbrella' => $umbrella,
        ]);
    }
}
