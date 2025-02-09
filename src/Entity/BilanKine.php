<?php

namespace App\Entity;

use App\Repository\BilanKineRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BilanKineRepository::class)]
class BilanKine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $inspection = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $palpation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mensuration = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bilanAlgique = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bilanArticulaire = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bilanMusculaire = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bilanNeurologique = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bilanPsychologique = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bilanFonctionnel = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $testsSpecifiques = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $remarque = null;

    #[ORM\OneToOne(inversedBy: 'bilanKine', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Patient $patientID = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInspection(): ?string
    {
        return $this->inspection;
    }

    public function setInspection(?string $inspection): static
    {
        $this->inspection = $inspection;

        return $this;
    }

    public function getPalpation(): ?string
    {
        return $this->palpation;
    }

    public function setPalpation(?string $palpation): static
    {
        $this->palpation = $palpation;

        return $this;
    }

    public function getMensuration(): ?string
    {
        return $this->mensuration;
    }

    public function setMensuration(?string $mensuration): static
    {
        $this->mensuration = $mensuration;

        return $this;
    }

    public function getBilanAlgique(): ?string
    {
        return $this->bilanAlgique;
    }

    public function setBilanAlgique(?string $bilanAlgique): static
    {
        $this->bilanAlgique = $bilanAlgique;

        return $this;
    }

    public function getBilanArticulaire(): ?string
    {
        return $this->bilanArticulaire;
    }

    public function setBilanArticulaire(?string $bilanArticulaire): static
    {
        $this->bilanArticulaire = $bilanArticulaire;

        return $this;
    }

    public function getBilanMusculaire(): ?string
    {
        return $this->bilanMusculaire;
    }

    public function setBilanMusculaire(?string $bilanMusculaire): static
    {
        $this->bilanMusculaire = $bilanMusculaire;

        return $this;
    }

    public function getBilanNeurologique(): ?string
    {
        return $this->bilanNeurologique;
    }

    public function setBilanNeurologique(?string $bilanNeurologique): static
    {
        $this->bilanNeurologique = $bilanNeurologique;

        return $this;
    }

    public function getBilanPsychologique(): ?string
    {
        return $this->bilanPsychologique;
    }

    public function setBilanPsychologique(?string $bilanPsychologique): static
    {
        $this->bilanPsychologique = $bilanPsychologique;

        return $this;
    }

    public function getBilanFonctionnel(): ?string
    {
        return $this->bilanFonctionnel;
    }

    public function setBilanFonctionnel(?string $bilanFonctionnel): static
    {
        $this->bilanFonctionnel = $bilanFonctionnel;

        return $this;
    }

    public function getTestsSpecifiques(): ?string
    {
        return $this->testsSpecifiques;
    }

    public function setTestsSpecifiques(?string $testsSpecifiques): static
    {
        $this->testsSpecifiques = $testsSpecifiques;

        return $this;
    }

    public function getRemarque(): ?string
    {
        return $this->remarque;
    }

    public function setRemarque(?string $remarque): static
    {
        $this->remarque = $remarque;

        return $this;
    }

    public function getPatientID(): ?Patient
    {
        return $this->patientID;
    }

    public function setPatientID(Patient $patientID): static
    {
        $this->patientID = $patientID;

        return $this;
    }

}
