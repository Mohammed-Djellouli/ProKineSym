<?php

namespace App\Entity;

use App\Repository\DecisionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DecisionRepository::class)]
class Decision
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prescription = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $conclusion = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $projet = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $diagnostique = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $objectifs = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $traitement = null;

    #[ORM\OneToOne(inversedBy: 'decision', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Patient $PatientID = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrescription(): ?string
    {
        return $this->prescription;
    }

    public function setPrescription(?string $prescription): static
    {
        $this->prescription = $prescription;

        return $this;
    }

    public function getConclusion(): ?string
    {
        return $this->conclusion;
    }

    public function setConclusion(?string $conclusion): static
    {
        $this->conclusion = $conclusion;

        return $this;
    }

    public function getProjet(): ?string
    {
        return $this->projet;
    }

    public function setProjet(?string $projet): static
    {
        $this->projet = $projet;

        return $this;
    }

    public function getDiagnostique(): ?string
    {
        return $this->diagnostique;
    }

    public function setDiagnostique(?string $diagnostique): static
    {
        $this->diagnostique = $diagnostique;

        return $this;
    }

    public function getObjectifs(): ?string
    {
        return $this->objectifs;
    }

    public function setObjectifs(?string $objectifs): static
    {
        $this->objectifs = $objectifs;

        return $this;
    }

    public function getTraitement(): ?string
    {
        return $this->traitement;
    }

    public function setTraitement(?string $traitement): static
    {
        $this->traitement = $traitement;

        return $this;
    }

    public function getPatientID(): ?Patient
    {
        return $this->PatientID;
    }

    public function setPatientID(Patient $PatientID): static
    {
        $this->PatientID = $PatientID;

        return $this;
    }
}
