<?php

namespace App\Controller;

use App\Form\UmbrellasType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
	$form=$this->createForm(UmbrellasType::class);
        return $this->render('home/index.html.twig', [
            'umbrella' => $form->createView(),
        ]);
    }
}
