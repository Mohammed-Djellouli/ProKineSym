<?php

namespace App\Entity;

use App\Repository\PatientRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PatientRepository::class)]
class Patient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $numTel = null;

    #[ORM\Column(nullable: true)]
    private ?int $age = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateNaissance = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $grpSanguin = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isFumeur = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isDiabetique = null;

    #[ORM\Column(nullable: true)]
    private ?bool $hasMaladieCardiaque = null;

    #[ORM\Column(nullable: true)]
    private ?bool $hasHypertension = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $AntecedentsMedicaux = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $antecedentsChirurigicaux = null;

    #[ORM\ManyToOne(inversedBy: 'patient')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToOne(mappedBy: 'PatientID', cascade: ['persist', 'remove'])]
    private ?Decision $decision = null;

    #[ORM\OneToOne(mappedBy: 'patientID', cascade: ['persist', 'remove'])]
    private ?BilanKine $bilanKine = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $Sexe = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Profession = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $SituationFamilliale = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $medecinPrescripteur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $DiagnosticMedical = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $HistoireMaladi = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CompteRendu = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Adresse = null;



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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getNumTel(): ?string
    {
        return $this->numTel;
    }

    public function setNumTel(?string $numTel): static
    {
        $this->numTel = $numTel;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(?\DateTimeInterface $dateNaissance): static
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getGrpSanguin(): ?string
    {
        return $this->grpSanguin;
    }

    public function setGrpSanguin(?string $grpSanguin): static
    {
        $this->grpSanguin = $grpSanguin;

        return $this;
    }

    public function isFumeur(): ?bool
    {
        return $this->isFumeur;
    }

    public function setIsFumeur(?bool $isFumeur): static
    {
        $this->isFumeur = $isFumeur;

        return $this;
    }

    public function isDiabetique(): ?bool
    {
        return $this->isDiabetique;
    }

    public function setIsDiabetique(?bool $isDiabetique): static
    {
        $this->isDiabetique = $isDiabetique;

        return $this;
    }

    public function hasMaladieCardiaque(): ?bool
    {
        return $this->hasMaladieCardiaque;
    }

    public function setHasMaladieCardiaque(?bool $hasMaladieCardiaque): static
    {
        $this->hasMaladieCardiaque = $hasMaladieCardiaque;

        return $this;
    }

    public function hasHypertension(): ?bool
    {
        return $this->hasHypertension;
    }

    public function setHasHypertension(?bool $hasHypertension): static
    {
        $this->hasHypertension = $hasHypertension;

        return $this;
    }

    public function getAntecedentsMedicaux(): ?string
    {
        return $this->AntecedentsMedicaux;
    }

    public function setAntecedentsMedicaux(?string $AntecedentsMedicaux): static
    {
        $this->AntecedentsMedicaux = $AntecedentsMedicaux;

        return $this;
    }

    public function getAntecedentsChirurigicaux(): ?string
    {
        return $this->antecedentsChirurigicaux;
    }

    public function setAntecedentsChirurigicaux(?string $antecedentsChirurigicaux): static
    {
        $this->antecedentsChirurigicaux = $antecedentsChirurigicaux;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getDecision(): ?Decision
    {
        return $this->decision;
    }

    public function setDecision(Decision $decision): static
    {
        // set the owning side of the relation if necessary
        if ($decision->getPatientID() !== $this) {
            $decision->setPatientID($this);
        }

        $this->decision = $decision;

        return $this;
    }

    public function getBilanKine(): ?BilanKine
    {
        return $this->bilanKine;
    }

    public function setBilanKine(BilanKine $bilanKine): static
    {
        // set the owning side of the relation if necessary
        if ($bilanKine->getPatientID() !== $this) {
            $bilanKine->setPatientID($this);
        }

        $this->bilanKine = $bilanKine;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->Sexe;
    }

    public function setSexe(?string $Sexe): static
    {
        $this->Sexe = $Sexe;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->Profession;
    }

    public function setProfession(?string $Profession): static
    {
        $this->Profession = $Profession;

        return $this;
    }

    public function getSituationFamilliale(): ?string
    {
        return $this->SituationFamilliale;
    }

    public function setSituationFamilliale(?string $SituationFamilliale): static
    {
        $this->SituationFamilliale = $SituationFamilliale;

        return $this;
    }

    public function getMedecinPrescripteur(): ?string
    {
        return $this->medecinPrescripteur;
    }

    public function setMedecinPrescripteur(?string $medecinPrescripteur): static
    {
        $this->medecinPrescripteur = $medecinPrescripteur;

        return $this;
    }

    public function getDiagnosticMedical(): ?string
    {
        return $this->DiagnosticMedical;
    }

    public function setDiagnosticMedical(?string $DiagnosticMedical): static
    {
        $this->DiagnosticMedical = $DiagnosticMedical;

        return $this;
    }

    public function getHistoireMaladi(): ?string
    {
        return $this->HistoireMaladi;
    }

    public function setHistoireMaladi(?string $HistoireMaladi): static
    {
        $this->HistoireMaladi = $HistoireMaladi;

        return $this;
    }

    public function getCompteRendu(): ?string
    {
        return $this->CompteRendu;
    }

    public function setCompteRendu(?string $CompteRendu): static
    {
        $this->CompteRendu = $CompteRendu;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(?string $Adresse): static
    {
        $this->Adresse = $Adresse;

        return $this;
    }

}
