<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Repository\RecipeRepository;

use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CookingController extends AbstractController
{
    /**
     * @Route("/", name="cooking")
     */
    public function index(Request $request, RecipeRepository $recipeRepository, PaginatorInterface $paginator): Response
    {
        $data = $recipeRepository->findAll();
        $recipe = $paginator->paginate($data, $request->query->getInt('page', 1), 12);

        return $this->render('cooking/index.html.twig', [
            'recipe' => $recipe
        ]);
    }

    /**
     * @route("/category/{id}", name="cooking_category", methods={"GET"})
     */
    public function category(RecipeRepository $recipeRepository, $id): Response
    {
        $recipe = $recipeRepository->findByByCategory($id);

        return $this->render('cooking/category.html.twig', [
            'recipe' => $recipe
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
        $recipe = $recipeRepository->findAll();
        $re = [];
        $i = 0;
        foreach ($recipe as $r) {
            $re[$i] = $r->getId();
            $i++;
        }
        $lucky = array_rand($re, 1);
        $recipelucky = $recipeRepository->find($re[$lucky]);
        return $this->render('cooking/lucky.html.twig', [
            'recipe' => $recipelucky,
        ]);
    }

    /**
     * barre de recherche ajax
     *
     * @Route("/search/{search}", name="ajax_search", methods={"GET"})

     */
    public function rechercheAjax($search,Request $request, RecipeRepository $recipeRepository)
    {
        $i=$search;
        $motClef = $request->get('Q');

        $data = $recipeRepository->findbar($motClef);

        if (!$data) {
            $result['result']['error'] = "Aucun résultat";
        } else {
            $result['result'] = $this->getRealEntities($data);
        }
//        return new Response(json_encode($result));

    }

    public function getRealEntities($data)
    {

        foreach ($data as $d) {
            $realEntities[$d->getId()] = $d->getFoo();
        }
        return $realEntities;
    }


}
