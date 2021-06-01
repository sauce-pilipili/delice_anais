<?php

namespace App\Controller;

use App\Repository\RecipeRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CookingController extends AbstractController
{
    /**
     * @Route("/cooking", name="cooking")
     */
    public function index(RecipeRepository $recipeRepository): Response
    {
        $recipe = $recipeRepository->findAll();

        return $this->render('cooking/index.html.twig', [
            'controller_name' => 'CookingController',
            'recipe'=> $recipe
        ]);
    }

    /**
     * @route(=
     */
}
