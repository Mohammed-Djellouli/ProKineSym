<?php

namespace App\Form;

use App\Entity\BilanKine;
use App\Entity\Patient;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BilanKineFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('inspection',TextareaType::class,[
                'attr' => [
                    'class' => 'form-control',
                ],
                'required'=>false,
            ])
            ->add('palpation',TextareaType::class,[
                'attr' => [
                    'class' => 'form-control',
                ],
                'required'=>false,
            ])
            ->add('mensuration',TextareaType::class,[
                'attr' => [
                    'class' => 'form-control',
                ],
                'required'=>false,
            ])
            ->add('bilanAlgique',TextareaType::class,[
                'attr' => [
                    'class' => 'form-control',
                ],
                'required'=>false,
            ])
            ->add('bilanArticulaire',TextareaType::class,[
                'attr' => [
                    'class' => 'form-control',
                ],
                'required'=>false,
            ])
            ->add('bilanMusculaire',TextareaType::class,[
                'attr' => [
                    'class' => 'form-control',
                ],
                'required'=>false,
            ])
            ->add('bilanNeurologique',TextareaType::class,[
                'attr' => [
                    'class' => 'form-control',
                ],
                'required'=>false,
            ])
            ->add('bilanPsychologique',TextareaType::class,[
                'attr' => [
                    'class' => 'form-control',
                ],
                'required'=>false,
            ])
            ->add('bilanFonctionnel',TextareaType::class,[
                'attr' => [
                    'class' => 'form-control',
                ],
                'required'=>false,
            ])
            ->add('testsSpecifiques',TextareaType::class,[
                'attr' => [
                    'class' => 'form-control',
                ],
                'required'=>false,
            ])
            ->add('remarque',TextareaType::class,[
                'attr' => [
                    'class' => 'form-control',
                ],
                'required'=>false,
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
            'data_class' => BilanKine::class,
        ]);
    }
}
