<?php

namespace App\Controller;

use App\Entity\Umbrella;
use App\Form\UmbrellasType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UmbrellaController extends AbstractController{
    #[Route('/umbrella/{id}', name: 'modify_umbrella')]
    #[Route('/umbrella', name: 'add_umbrella')]
    public function index(Umbrella $umbrella = null,Request $request, EntityManagerInterface $entityManager): Response
    {
	if(!$umbrella){
		$umbrella=new Umbrella;
	}
	$form = $this->createForm(UmbrellasType::class,$umbrella);

	// Récupération des données POST du formulaire
	$form->handleRequest($request);
	// Vérification si le formulaire est soumis et Valide
	if($form->isSubmitted() && $form->isValid()){
	    // Persistance des données
	    $entityManager->persist($umbrella);
	    // Envoi en BDD
	    $entityManager->flush();

	    // Redirection de l'utilisateur
	    return $this->redirectToRoute('home');
	}
        return $this->render('umbrella/addupdate.html.twig', [
            'umbrellaform' => $form->createView(), //envoie du formulaire en VUE
            'isModification' => $umbrella->getId() !== null 
        ]);
    }

    #[Route('/umbrella/delete/{id}', name: 'delete_umbrella')]
    public function remove(Umbrella $umbrella, Request $request, EntityManagerInterface $entityManager): Response
    {
        
        

        if($this->isCsrfTokenValid('SUP'.$umbrella->getId(),$request->get('_token'))){
            $entityManager->remove($umbrella);
            $entityManager->flush();
            $this->addFlash('success','La suppression à été effectuée');
            return $this->redirectToRoute('home');

        }
    }
}
