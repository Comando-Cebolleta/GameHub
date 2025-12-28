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

class PersonajeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // 1. Selección del Personaje Base (Raiden, Zhongli, etc.)
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

            // 3. El Arma (Formulario embebido/anidado 1 a 1)
            // Esto renderizará el ArmaType dentro de este formulario
            ->add('arma', ArmaType::class, [
                'label' => 'Arma equipada',
                'required' => true,
            ])

            // 4. Los Artefactos (Colección 1 a N)
            // allow_add: permite añadir nuevos artefactos desde JS
            // by_reference: false es OBLIGATORIO para que llame a addArtefacto() en la entidad
            ->add('artefactos', CollectionType::class, [
                'entry_type' => ArtefactoType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false, 
                'label' => 'Artefactos',
            ])

            ->add('guardar', SubmitType::class, [
                'label' => 'Guardar Build',
                'attr' => ['class' => 'btn btn-primary mt-3']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personaje::class,
        ]);
    }
}