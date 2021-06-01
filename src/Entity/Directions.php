<?php

namespace App\Entity;

use App\Repository\DirectionsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DirectionsRepository::class)
 */
class Directions
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
    private $toDO;

    /**
     * @ORM\ManyToOne(targetEntity=Recipe::class, inversedBy="directions")
     */
    private $recipe;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getToDO(): ?string
    {
        return $this->toDO;
    }

    public function setToDO(string $toDO): self
    {
        $this->toDO = $toDO;

        return $this;
    }

    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    public function setRecipe(?Recipe $recipe): self
    {
        $this->recipe = $recipe;

        return $this;
    }
}
