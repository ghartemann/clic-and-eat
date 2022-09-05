<?php

namespace App\Entity;

use App\Repository\ShopRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShopRepository::class)]
class Shop
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'shop', targetEntity: GroceryList::class)]
    private Collection $groceryLists;

    public function __construct()
    {
        $this->groceryLists = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, GroceryList>
     */
    public function getGroceryLists(): Collection
    {
        return $this->groceryLists;
    }

    public function addGroceryList(GroceryList $groceryList): self
    {
        if (!$this->groceryLists->contains($groceryList)) {
            $this->groceryLists->add($groceryList);
            $groceryList->setShop($this);
        }

        return $this;
    }

    public function removeGroceryList(GroceryList $groceryList): self
    {
        if ($this->groceryLists->removeElement($groceryList)) {
            // set the owning side to null (unless already changed)
            if ($groceryList->getShop() === $this) {
                $groceryList->setShop(null);
            }
        }

        return $this;
    }
}
