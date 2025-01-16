<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $category = null;

    /**
     * @var Collection<int, Umbrella>
     */
    #[ORM\OneToMany(targetEntity: Umbrella::class, mappedBy: 'category')]
    private Collection $user;

    public function __construct()
    {
        $this->user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Umbrella>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(Umbrella $user): static
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
            $user->setCategory($this);
        }

        return $this;
    }

    public function removeUser(Umbrella $user): static
    {
        if ($this->user->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCategory() === $this) {
                $user->setCategory(null);
            }
        }

        return $this;
    }
}
