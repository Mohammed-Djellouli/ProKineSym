<?php

namespace App\Form;

use App\Entity\Patient;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType; // Assurez-vous que cette ligne est présente
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class PatientFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez le nom du patient',
                ],
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez le prénom du patient',
                ],
            ])
            ->add('email', TextType::class, [
                'label' => 'Email',
                'required'=> false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez l\'email du patient',
                ],
            ])
            ->add('numTel', TextType::class, [
                'label' => 'Numéro de téléphone',
                'required'=> false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez le numéro de téléphone du patient',
                ],
            ])
            ->add('adresse', TextType::class, [
                'label' => 'Adresse',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez le prénom du patient',
                ],
            ])
            ->add('sexe', ChoiceType::class, [
                'required'=> false,
                'label' => 'Sexe',
                'choices' => [
                    'Homme' => 'Homme',
                    'Femme' => 'Femme',
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('profession', TextType::class, [
                'required'=> false,
                'label' => 'Profession',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('situationFamilliale', ChoiceType::class, [
                'required'=> false,
                'label' => 'Situation familiale',
                'choices' => [
                    'Cilébataire' => 'Cilébataire',
                    'Marié' => 'Marié',
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('age', TextType::class, [
                'required'=> false,
                'label' => 'Âge',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez l\'âge du patient',
                ],
            ])
            ->add('dateNaissance', DateType::class, [
                'required'=> false,
                'label' => 'Date de naissance',
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('grpSanguin', ChoiceType::class, [
                'required'=> false,
                'label' => 'Groupe sanguin',
                'choices' => [
                    'A+' => 'A+',
                    'A-' => 'A-',
                    'B+' => 'B+',
                    'B-' => 'B-',
                    'AB+' => 'AB+',
                    'AB-' => 'AB-',
                    'O+' => 'O+',
                    'O-' => 'O-',
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('isFumeur', ChoiceType::class, [
                'required'=> false,
                'label' => 'Fumeur ?',
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                ],
                'expanded' => true,
            ])
            ->add('isDiabetique', ChoiceType::class, [
                'required'=> false,
                'label' => 'Diabétique ?',
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                ],
                'expanded' => true,
            ])
            ->add('hasMaladieCardiaque', ChoiceType::class, [
                'required'=> false,
                'label' => 'Maladie cardiaque ?',
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                ],
                'expanded' => true,
            ])
            ->add('hasHypertension', ChoiceType::class, [
                'required'=> false,
                'label' => 'Hypertension ?',
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                ],
                'expanded' => true,
            ])
            ->add('medecinPrescripteur', TextType::class, [
                'required'=> false,
                'label' => 'Médecin prescripteur',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Médecin prescripteur',
                ],
            ])
            ->add('diagnosticMedical', TextType::class, [
                'required'=> false,
                'label' => 'Diagnostic Médical',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('age', TextType::class, [
                'required'=> false,
                'label' => 'Âge',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez l\'âge du patient',
                ],
            ])
            ->add('antecedentsMedicaux', TextType::class, [
                'required'=> false,
                'label' => 'Antécédents médicaux',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('antecedentsChirurigicaux', TextType::class, [
                'required'=> false,
                'label' => 'Antécédents chirurgicaux',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('histoireMaladi', TextType::class, [
                'required'=> false,
                'label' => 'Histoire de la maladie',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('compteRendu', TextType::class, [
                'required'=> false,
                'label' => 'Compte Rendu',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('submit' ,SubmitType::class,[
                'label' => 'Valider',
                'attr' =>[
                    'class' => "btn btn-success"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Patient::class,
        ]);
    }
}
