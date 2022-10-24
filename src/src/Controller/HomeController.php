<?php

namespace App\Controller;

use App\Entity\Tag;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

	#[Route('/', name: 'app_home')]
	public function index(
		EntityManagerInterface $entityManager
	): Response {
		$repositoryTag = $entityManager->getRepository(Tag::class);
		$tags       = $repositoryTag->findAll();


		return $this->render('home/index.html.twig', [
			'controller_name' => 'HomeController',
			'tags' => $tags,
		]);
	}
}