<?php

namespace App\Entity;

use App\Repository\ImageRecipeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImageRecipeRepository::class)
 */
class ImageRecipe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity=Recipe::class, mappedBy="image", cascade={"persist", "remove"})
     */
    private $recipe;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    public function setRecipe(?Recipe $recipe): self
    {
        // unset the owning side of the relation if necessary
        if ($recipe === null && $this->recipe !== null) {
            $this->recipe->setImage(null);
        }

        // set the owning side of the relation if necessary
        if ($recipe !== null && $recipe->getImage() !== $this) {
            $recipe->setImage($this);
        }

        $this->recipe = $recipe;

        return $this;
    }
}
