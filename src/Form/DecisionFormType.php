<?php

namespace App\Form;

use App\Entity\Decision;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DecisionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prescription',TextareaType::class,[
                'attr' => [
                    'class' => 'form-control',
                ],
                'required'=>false,
            ])
            ->add('conclusion',TextareaType::class,[
                'attr' => [
                    'class' => 'form-control',
                ],
                'required'=>false,
            ])
            ->add('projet',TextareaType::class,[
                'attr' => [
                    'class' => 'form-control',
                ],
                'required'=>false,
            ])
            ->add('diagnostique',TextareaType::class,[
                'attr' => [
                    'class' => 'form-control',
                ],
                'required'=>false,
            ])
            ->add('objectifs',TextareaType::class,[
                'attr' => [
                    'class' => 'form-control',
                ],
                'required'=>false,
            ])
            ->add('traitement',TextareaType::class,[
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
            'data_class' => Decision::class,
        ]);
    }
}
