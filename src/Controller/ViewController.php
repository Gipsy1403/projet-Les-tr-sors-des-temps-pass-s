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
        return $this->render('view/view.html.twig', [
            'umbrella' => $umbrella,
		]);
    }

    #[Route('/comment/new', name: 'comment_view')]
        public function index(Request $request, EntityManagerInterface $entityManager): Response
    {

	$comment=new Comment();
	$form = $this->createForm(CommentType::class,$comment);
	$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()){
		$entityManager->persist($comment);
		$entityManager->flush();
		return $this->redirectToRoute('view');
	}
	return $this->render('view/view.html.twig', [
		'commentform' => $form->createView(), 
	]);
}
}
