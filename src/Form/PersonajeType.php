<?php

namespace App\Form;

use App\Entity\Personaje;
use App\Entity\PersonajePlantilla;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

// IMPORTANTE: Clase en desuso, ahora usamos GenshinBuildType y HonkaiBuildType
// que también crean objetos Personaje
class PersonajeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // 1. Selección del Personaje Base
            ->add('personajePlantilla', EntityType::class, [
                'class' => PersonajePlantilla::class,
                'choice_label' => 'nombre',
                'label' => 'Personaje',
                'placeholder' => 'Selecciona un personaje...',
                'attr' => ['class' => 'form-select personaje-selector'],
            ])
            
            // 2. Datos básicos de la instancia
            ->add('nivel', IntegerType::class, [
                'label' => 'Nivel',
                'attr' => ['min' => 1, 'max' => 90, 'class' => 'form-control'],
            ])
            ->add('dupeNum', IntegerType::class, [
                'label' => 'Constelaciones / Eidolons',
                'attr' => ['min' => 0, 'max' => 6, 'class' => 'form-control'],
            ])

            // 3. El Arma
            // ->add('arma', ArmaType::class, [
            //     'label' => 'Arma equipada',
            //     'required' => true,
            // ])

            // 4. Los Artefactos
            // ->add('artefacto_flor', ArtefactoType::class, [
            //     'mapped' => false,
            //     'label' => false,
            //     'tipo_pieza_nombre' => 'Flor',
            // ])
            // ->add('artefacto_pluma', ArtefactoType::class, [
            //     'mapped' => false,
            //     'label' => false,
            //     'tipo_pieza_nombre' => 'Pluma',
            // ])
            // ->add('artefacto_reloj', ArtefactoType::class, [
            //     'mapped' => false,
            //     'label' => false,
            //     'tipo_pieza_nombre' => 'Reloj',
            // ])
            // ->add('artefacto_copa', ArtefactoType::class, [
            //     'mapped' => false,
            //     'label' => false,
            //     'tipo_pieza_nombre' => 'Copa',
            // ])
            // ->add('artefacto_casco', ArtefactoType::class, [
            //     'mapped' => false,
            //     'label' => false,
            //     'tipo_pieza_nombre' => 'Casco', 
            // ])

            // ->add('guardar', SubmitType::class, [
            //     'label' => 'Guardar Build',
            //     'attr' => ['class' => 'btn btn-primary mt-3']
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personaje::class,
        ]);
    }
}