<?php

namespace App\Entity;

use App\Repository\ToppingsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ToppingsRepository::class)]
class Toppings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    /**
     * @var Collection<int, Glace>
     */
    #[ORM\ManyToMany(targetEntity: Glace::class, mappedBy: 'toppings')]
    private Collection $glaces;

    public function __construct()
    {
        $this->glaces = new ArrayCollection(); // ✅ correct
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return Collection<int, Glace>
     */
    public function getGlaces(): Collection
    {
        return $this->glaces;
    }

    public function addGlace(Glace $glace): static
    {
        if (!$this->glaces->contains($glace)) {
            $this->glaces[] = $glace;
        }

        return $this;
    }

    public function removeGlace(Glace $glace): static
    {
        $this->glaces->removeElement($glace);
        return $this;
    }
}
