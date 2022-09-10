<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
class Recipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $picture = null;

    #[ORM\Column(nullable: true)]
    private ?int $cookingTime = null;

    #[ORM\Column(nullable: true)]
    private ?int $prepTime = null;

    #[ORM\Column(nullable: true)]
    private ?int $restTime = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private array $steps = [];

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $youtube = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $url = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $doc = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $book = null;

    #[ORM\Column(nullable: true)]
    private ?int $page = null;

    #[ORM\Column]
    private ?bool $vg = null;

    #[ORM\Column(nullable: true)]
    private ?int $servings = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $notes = null;

    #[ORM\ManyToOne(inversedBy: 'recipes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Type $type = null;

    #[ORM\ManyToMany(targetEntity: Userlist::class, inversedBy: 'recipes')]
    private Collection $userlists;

    #[ORM\ManyToOne(inversedBy: 'recipes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Dish $dishType = null;

    #[ORM\ManyToMany(targetEntity: IngredientRecipe::class, mappedBy: 'Recipe')]
    private Collection $recipeIngredients;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
        $this->userlists = new ArrayCollection();
        $this->recipeIngredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getCookingTime(): ?int
    {
        return $this->cookingTime;
    }

    public function setCookingTime(?int $cookingTime): self
    {
        $this->cookingTime = $cookingTime;

        return $this;
    }

    public function getPrepTime(): ?int
    {
        return $this->prepTime;
    }

    public function setPrepTime(?int $prepTime): self
    {
        $this->prepTime = $prepTime;

        return $this;
    }

    public function getRestTime(): ?int
    {
        return $this->restTime;
    }

    public function setRestTime(?int $restTime): self
    {
        $this->restTime = $restTime;

        return $this;
    }

    public function getSteps(): array
    {
        return $this->steps;
    }

    public function setSteps(?array $steps): self
    {
        $this->steps = $steps;

        return $this;
    }

    public function getYoutube(): ?string
    {
        return $this->youtube;
    }

    public function setYoutube(?string $youtube): self
    {
        $this->youtube = $youtube;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getDoc(): ?string
    {
        return $this->doc;
    }

    public function setDoc(?string $doc): self
    {
        $this->doc = $doc;

        return $this;
    }

    public function getBook(): ?string
    {
        return $this->book;
    }

    public function setBook(?string $book): self
    {
        $this->book = $book;

        return $this;
    }

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function setPage(?int $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function isVg(): ?bool
    {
        return $this->vg;
    }

    public function setVg(bool $vg): self
    {
        $this->vg = $vg;

        return $this;
    }

    public function getServings(): ?int
    {
        return $this->servings;
    }

    public function setServings(?int $servings): self
    {
        $this->servings = $servings;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Userlist>
     */
    public function getUserlists(): Collection
    {
        return $this->userlists;
    }

    public function addUserlist(Userlist $userlist): self
    {
        if (!$this->userlists->contains($userlist)) {
            $this->userlists->add($userlist);
        }

        return $this;
    }

    public function removeUserlist(Userlist $userlist): self
    {
        $this->userlists->removeElement($userlist);

        return $this;
    }

    public function getDishType(): ?Dish
    {
        return $this->dishType;
    }

    public function setDishType(?Dish $dishType): self
    {
        $this->dishType = $dishType;

        return $this;
    }

    /**
     * @return Collection<int, IngredientRecipe>
     */
    public function getRecipeIngredients(): Collection
    {
        return $this->recipeIngredients;
    }

    public function addRecipeIngredient(IngredientRecipe $recipeIngredient): self
    {
        if (!$this->recipeIngredients->contains($recipeIngredient)) {
            $this->recipeIngredients->add($recipeIngredient);
            $recipeIngredient->addRecipe($this);
        }

        return $this;
    }

    public function removeRecipeIngredient(IngredientRecipe $recipeIngredient): self
    {
        if ($this->recipeIngredients->removeElement($recipeIngredient)) {
            $recipeIngredient->removeRecipe($this);
        }

        return $this;
    }
}
