<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Repository\RecipeRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CookingController extends AbstractController
{
    /**
     * @Route("/", name="cooking")
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
     * @route("/category/{id}", name="cooking_category", methods={"GET"})
     */
    public function category(RecipeRepository $recipeRepository,$id): Response
    {
        $recipe = $recipeRepository->findByByCategory($id);

        return $this->render('cooking/category.html.twig', [
            'controller_name' => 'CookingController',
            'recipe'=> $recipe
        ]);
    }
    /**
     * @Route("/detail{id}", name="cooking_detail", methods={"GET"})
     */
    public function show(Recipe $recipe): Response
    {

        return $this->render('recipe/show.html.twig', [
            'recipe' => $recipe,
        ]);
    }

    /**
     * @Route("/lucky", name="cooking_lucky")
     */
    public function hasardshow(RecipeRepository $recipeRepository): Response
    {
        $number = $recipeRepository->hasardcount();
        $id = random_int(1,$number);
        $recipe = $recipeRepository->find($id);



        return $this->render('cooking/lucky.html.twig', [
            'recipe' => $recipe,
        ]);
    }
}
