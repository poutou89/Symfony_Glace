<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\GlaceRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: GlaceRepository::class)]
#[Vich\Uploadable]
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
    #[ORM\JoinColumn(name: 'cornet_id', referencedColumnName: 'id', nullable: false)]
    private ?Cornet $cornet = null;

    #[ORM\ManyToMany(targetEntity: Toppings::class, inversedBy: 'glaces')]
    private Collection $toppings;

    #[Vich\UploadableField(mapping: 'images', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
        $this->toppings = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }
    public function setId(int $id): static { $this->id = $id; return $this; }

    public function getNom(): ?string { return $this->nom; }
    public function setNom(string $nom): static { $this->nom = $nom; return $this; }

    public function getSupp(): ?string { return $this->supp; }
    public function setSupp(?string $supp): static { $this->supp = $supp; return $this; }

    public function getCornet(): ?Cornet { return $this->cornet; }
    public function setCornet(?Cornet $cornet): static { $this->cornet = $cornet; return $this; }

    public function getToppings(): Collection { return $this->toppings; }

    public function addTopping(Toppings $topping): static {
        if (!$this->toppings->contains($topping)) {
            $this->toppings->add($topping);
            $topping->addGlace($this);
        }
        return $this;
    }

    public function removeTopping(Toppings $topping): static {
        if ($this->toppings->removeElement($topping)) {
            $topping->removeGlace($this);
        }
        return $this;
    }

    public function setImageFile(?File $imageFile = null): void {
        $this->imageFile = $imageFile;
        if ($imageFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string {
        return $this->imageName;
    }
}