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

// IMPORTANTE: Clase en desuso
class ArtefactoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Obtenemos el nombre del tipo desde el formulario padre
        $tipoPieza = $options['tipo_pieza_nombre'];

        // Definimos la lista completa de stats posibles
        $statsGenerales = [
            'Vida (HP)' => 'HP',
            'Vida %' => 'HP%',

            'Ataque (ATK)' => 'ATK',
            'Ataque %' => 'ATK%',

            'Defensa (DEF)' => 'DEF',
            'Defensa %' => 'DEF%',

            'Maestría Elemental' => 'EM',
            'Recarga de Energía' => 'ER',

            'Bono Daño Pyro' => 'PYRO_DMG_BONUS',
            'Bono Daño Hydro' => 'HYDRO_DMG_BONUS',
            'Bono Daño Geo' => 'GEO_DMG_BONUS',
            'Bono Daño Dendro' => 'DENDRO_DMG_BONUS',
            'Bono Daño Electro' => 'ELECTRO_DMG_BONUS',
            'Bono Daño Anemo' => 'ANEMO_DMG_BONUS',
            'Bono Daño Cryo' => 'CRYO_DMG_BONUS',

            'Prob. Crítico' => 'CRIT_RATE',
            'Daño Crítico' => 'CRIT_DMG',

            'Bono Curación' => 'HEAL_BONUS',
        ];

        // Forzamos a que las flores y plumas tengan stats fijos
        $choices = match ($tipoPieza) {
            'Flor'  => ['Vida (HP)' => 'HP'],
            'Pluma' => ['Ataque (ATK)' => 'ATK'],
            default => $statsGenerales,
        };
        $isFixed = ($tipoPieza === 'Flor' || $tipoPieza === 'Pluma');

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
                'choices' => $choices, // Lista fija

                // Si la pieza es flor o pluma, le damos su único valor posible
                'data' => $isFixed ? array_values($choices)[0] : null,

                // Esto es para que el campo parezca bloqueado
                'attr' => [
                    'class' => $isFixed ? 'form-select bg-light' : 'form-select',
                    'readonly' => $isFixed
                ],
                'placeholder' => $isFixed ? false : 'Elige stat...',
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