<?php

namespace App\Form;

use App\Entity\Artefacto;
use App\Entity\ArtefactoPlantilla;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArtefactoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('artefactoPlantilla', EntityType::class, [
                'class' => ArtefactoPlantilla::class,
                'choice_label' => function (ArtefactoPlantilla $ap) {
                    // Muestra: "NombreSet - TipoPieza"
                    return $ap->getSetArtefactos()->getNombre() . ' - ' . $ap->getPiezaTipo()->getNombre();
                },
                'label' => 'Pieza',
                'placeholder' => 'Selecciona la pieza...',
                'attr' => ['class' => 'form-select mb-2'],
            ])
            // CAMPOS VIRTUALES (mapped => false)
            // El usuario rellena esto, y en el Controller nosotros crearemos el JSON
            ->add('statPrincipalNombre', ChoiceType::class, [
                'mapped' => false, 
                'label' => 'Stat Principal',
                'choices' => [
                    'ATQ' => 'ATQ', 'DEF' => 'DEF', 'VIDA' => 'VIDA', 
                    'Maestría' => 'EM', 'Recarga' => 'ER', 
                    'Bono Daño' => 'DMG', 'Crítico' => 'CRIT'
                ],
                'attr' => ['class' => 'form-select mb-2']
            ])
            ->add('statPrincipalValor', NumberType::class, [
                'mapped' => false,
                'label' => 'Valor',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Ej: 46.6']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Artefacto::class,
        ]);
    }
}