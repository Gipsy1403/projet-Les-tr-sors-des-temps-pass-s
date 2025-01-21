<?php

namespace App\Controller;

use App\Entity\Umbrella;

use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Egulias\EmailValidator\Warning\Comment;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

    public function index(Comment $comment = null,Request $request, EntityManagerInterface $entityManager): Response
    {

	$comment=new Comment;
		
	$form = $this->createForm(CommentType::class,$comment);

	// Récupération des données POST du formulaire
	$form->handleRequest($request);
	// Vérification si le formulaire est soumis et Valide
		if($form->isSubmitted() && $form->isValid()){
	// Persistance des données
		$entityManager->persist($comment);
	// Envoi en BDD
		$entityManager->flush();

	// Redirection de l'utilisateur
		return $this->redirectToRoute('view');
	}
	return $this->render('view/view.html.twig', [
		'commentform' => $form->createView(), //envoie du formulaire en VUE
		
	]);
}
}
