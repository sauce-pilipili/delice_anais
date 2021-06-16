<?php

namespace App\DataFixtures;

use App\Entity\Directions;
use App\Entity\ImageRecipe;
use App\Entity\Ingredient;
use App\Entity\Recipe;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;


class recipeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
       $faker = Faker\Factory::create('fr_FR');
       $sort = ['kg', 'g', 'cl', 'ml', 'pièces', 'C.a.café', 'C.a.soupe'];
       $cat = ['entrées', 'plats', 'desserts'];
       $image =['charcuterie.jpg','cheese.jpg','pancakes.jpg','pizza.jpg','pizza0.jpg','salad.jpg','salmon.jpg','shish-kebab.jpg'];



        for ($nbRecipe =1 ; $nbRecipe <= 100 ;$nbRecipe ++){
            $ingredient = [];
            for ($i = 1 ;$i <=100 ; $i++){
                $ingredient[$i] = new Ingredient();
                $ingredient[$i]->setNames($faker->sentence($nbWords = 6, $variableNbWords = true) )->setQuantity($faker->numberBetween(25,500));
                $rand = array_rand($sort, 1);
                $ingredient[$i]->setSort($sort[$rand]);
                $manager->persist($ingredient[$i]);
            }
            $direction = [];
            for ($i = 1 ;$i <=100 ; $i++){
                $direction[$i] = new Directions();
                $direction[$i]->setToDO($faker->sentence($nbWords = 14, $variableNbWords = true) );
                $manager->persist($direction[$i]);
            }
            $img = [];
            for ($j = 0 ;$j <= 7; $j++){
                $img[$j] = new ImageRecipe();
                $img[$j]->setName($image[$j]);
                $manager->persist($img[$j]);
            }

            $recipe = new Recipe();
            $x = array_rand($img,1);
            $recipe->setImage($img[$x]);

            $recipe->setName($faker->sentence($nbWords = 6, $variableNbWords = true));
            $rand1 = array_rand($cat, 1);
            $recipe->setCategory($cat[$rand1]);
            $recipe->setMachine($faker->sentence($nbWords = 3, $variableNbWords = true));
            $date = new DateTime('now');
            $recipe->setCreatedDate($date);
            for ($nb=1 ;$nb <= $faker->numberBetween(6,14); $nb++){
                $rand = array_rand($ingredient, 1);
                $recipe->addIngredient($ingredient[$rand]);
            $manager->persist($recipe);
            }
            for ($nbd=1 ;$nbd <= $faker->numberBetween(5,12); $nbd++){
                $randd = array_rand($direction, 1);
                $recipe->addDirection($direction[$randd]);
                $manager->persist($recipe);
            }

        }
        $manager->flush();
    }
}
