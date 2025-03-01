<?php

namespace App\Controller;

use App\Form\UmbrellasType;
use App\Repository\UmbrellaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController{
    #[Route('/', name: 'home')]
    public function index(UmbrellaRepository $repository): Response
    {
	// $form=$this->createForm(UmbrellasType::class);
     //    return $this->render('home/index.html.twig', [
     //        'umbrellaform' => $form->createView(),
     //    ]);
		
		$umbrella=$repository->findBy([], ["id"=>"DESC"],4);		
        	return $this->render('home/index.html.twig', [
            'umbrellas' => $umbrella, // on envoie la valeur de $umbrella dans la vue (home.html.twig)
        ]);
    }
}
