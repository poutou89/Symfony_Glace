<?php

namespace App\Entity;

use App\Repository\GlaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GlaceRepository::class)]
class Glace
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $supp = null;

    #[ORM\ManyToOne(targetEntity: Cornet::class)]
    #[ORM\JoinColumn(name: 'cornet_id', referencedColumnName: 'id', nullable: false)] // <--- clé étrangère personnalisée
    private ?Cornet $cornet = null;

    /**
     * @var Collection<int, Toppings>
     */
    #[ORM\ManyToMany(targetEntity: Toppings::class, inversedBy: 'glaces')]
    private Collection $toppings;

    public function __construct()
    {
        $this->toppings = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
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

    public function getSupp(): ?string
    {
        return $this->supp;
    }

    public function setSupp(?string $supp): static
    {
        $this->supp = $supp;

        return $this;
    }

    public function getCornet(): ?Cornet
    {
        return $this->cornet;
    }

    public function setCornet(?Cornet $cornet): static
    {
        $this->cornet = $cornet;
        return $this;
    }

    /**
     * @return Collection<int, Toppings>
     */
    public function getToppings(): Collection
    {
        return $this->toppings;
    }

    public function addTopping(Toppings $topping): static
{
    if (!$this->toppings->contains($topping)) {
        $this->toppings->add($topping);
        $topping->addGlace($this); // ✅ synchronise aussi l’autre côté
    }

    return $this;
}

public function removeTopping(Toppings $topping): static
{
    if ($this->toppings->removeElement($topping)) {
        $topping->removeGlace($this); // ✅ synchronise aussi l’autre côté
    }

    return $this;
}

}
