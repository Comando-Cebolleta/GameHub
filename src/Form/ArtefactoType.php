<?php
namespace App\Form;

use App\Entity\Artefacto;
use App\Entity\ArtefactoPlantilla;
use App\Entity\SetArtefactos;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert; 

class ArtefactoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Obtenemos el nombre del tipo desde el formulario padre
        $tipoPieza = $options['tipo_pieza_nombre'];

        $builder
            ->add('setSeleccionado', EntityType::class, [
                'class' => SetArtefactos::class,
                'mapped' => false, // IMPORTANTE: No es propiedad directa de Artefacto
                'choice_label' => 'nombre', // El nombre del set
                'label' => 'Selecciona un set ',
                'placeholder' => 'Selecciona el Set...',
                'required' => true,
                'attr' => ['class' => 'form-select mb-1'],
            ])
            
            ->add('statPrincipalNombre', ChoiceType::class, [
                'mapped' => false,
                'label' => 'Stat Principal',
                'choices' => [
                    'Vida %' => 'HP',
                    'Ataque %' => 'ATK',
                    'Defensa %' => 'DEF',
                    'Maestría Elemental' => 'EM',
                    'Recarga de Energía' => 'ER',
                    'Bono Daño Elemental' => 'DMG_BONUS',
                    'Prob. Crítico' => 'CRIT_RATE',
                    'Daño Crítico' => 'CRIT_DMG',
                    'Bono Curación' => 'HEAL_BONUS',
                ],
                'placeholder' => 'Elige stat...',
                'required' => true,
            ])
            ->add('statPrincipalValor', NumberType::class, [ 
                'mapped' => false,
             ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Artefacto::class,
        ]);
        $resolver->setRequired('tipo_pieza_nombre');
    }
}