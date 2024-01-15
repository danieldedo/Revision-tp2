<?php

namespace App\Entity;

use App\Repository\EmpruntRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmpruntRepository::class)]
class Emprunt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'emprunts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Livre $livre = null;

    #[ORM\ManyToOne(inversedBy: 'emprunts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Etudiant $etudiant = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $dateemprunt = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateretourprevue = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateretoureffective = null;


    public function __construct()
    {
        $this->dateemprunt = new \DateTimeImmutable();
    
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLivre(): ?Livre
    {
        return $this->livre;
    }

    public function setLivre(?Livre $livre): static
    {
        $this->livre = $livre;

        return $this;
    }

    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(?Etudiant $etudiant): static
    {
        $this->etudiant = $etudiant;

        return $this;
    }

    public function getDateemprunt(): ?\DateTimeImmutable
    {
        return $this->dateemprunt;
    }

    public function setDateemprunt(\DateTimeImmutable $dateemprunt): static
    {
        $this->dateemprunt = $dateemprunt;

        return $this;
    }

    public function getDateretourprevue(): ?\DateTimeInterface
    {
        return $this->dateretourprevue;
    }

    public function setDateretourprevue(\DateTimeInterface $dateretourprevue): static
    {
        $this->dateretourprevue = $dateretourprevue;

        return $this;
    }

    public function getDateretoureffective(): ?\DateTimeInterface
    {
        return $this->dateretoureffective;
    }

    public function setDateretoureffective(?\DateTimeInterface $dateretoureffective): static
    {
        $this->dateretoureffective = $dateretoureffective;

        return $this;
    }
}
