<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/recettes', name: 'app_recipe_')]
class RecipeController extends AbstractController
{
    #[Route('', name: 'index')]
    public function index(RecipeRepository $recipeRepository): Response
    {
        $recipes = $recipeRepository->findAll();

        return $this->render('recipe/index.html.twig', ['recipes' => $recipes]);
    }

    #[Route('/{id}', name: 'show')]
    public function show(Recipe $recipe): Response
    {
        return $this->render('recipe/show.html.twig', ['recipe' => $recipe]);
    }
}
