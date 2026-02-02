<?php

namespace App\Form;

use App\Entity\Artefacto;
use App\Entity\SetArtefactos;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HonkaiArtefactoType extends AbstractType
{
    const STATS_HSR = [
        'Vida (HP)' => 'HP', 'Vida %' => 'HP%', 'Ataque (ATK)' => 'ATK', 'Ataque %' => 'ATK%',
        'Defensa (DEF)' => 'DEF', 'Defensa %' => 'DEF%', 'Efecto de ruptura' => 'BREAK_EFFECT',
        'Acierto de efecto' => 'EFFECT_HIT_RATE', 'RES a efecto' => 'EFFECT_RES',
        'Velocidad' => 'SPD', 'Recarga de Energía' => 'ER', 'Bono Daño Físico' => 'PHYSICAL_DMG_BONUS',
        'Bono Daño Fuego' => 'FIRE_DMG_BONUS', 'Bono Daño Hielo' => 'ICE_DMG_BONUS',
        'Bono Daño Rayo' => 'LIGHTNING_DMG_BONUS', 'Bono Daño Viento' => 'WIND_DMG_BONUS',
        'Bono Daño Cuántico' => 'QUANTUM_DMG_BONUS', 'Bono Daño Imaginario' => 'IMAGINARY_DMG_BONUS',
        'Prob. Crítico' => 'CRIT_RATE', 'Daño Crítico' => 'CRIT_DMG', 'Bono Curación' => 'HEAL_BONUS',
    ];

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // El nombre del tipo de pieza que usaremos para filtrar (ej: "Cabeza" o "Esfera")
        // Porque en honkai hay 2 tipos de sets
        // Los de 4 piezas (cabeza, manos...) Y los de 2 que solo tienen esfera y cuerda
        // Necesitamos hacer esto para filtrar en el select del html el tipo de set
        $piezaTestigo = $options['pieza_testigo'];

        // Esta parte antes de $build filtra para forzar que las flores tengan HP y las plumas ATK
        $statFijo = $options['stat_fijo'];

        $opcionesStats = self::STATS_HSR;

        if ($statFijo) {
            $key = array_search($statFijo, self::STATS_HSR);
            $opcionesStats = [$key => $statFijo];
        }

        $builder
            ->add('setSeleccionado', EntityType::class, [
                'class' => SetArtefactos::class,
                'choice_label' => 'nombre',
                'label' => 'Set',
                'mapped' => false,
                'query_builder' => function (EntityRepository $er) use ($piezaTestigo) {
                    $qb = $er->createQueryBuilder('s')
                        ->where('s.juego = :j')
                        ->setParameter('j', 'hsr')
                        ->orderBy('s.nombre', 'ASC');

                    if ($piezaTestigo) {
                        // Hacemos JOIN: SetArtefactos -> ArtefactoPlantilla -> PiezaTipo
                        $qb->join('s.artefactoPlantillas', 'p') 
                           ->join('p.piezaTipo', 'pt')
                           ->andWhere('pt.codigo = :codigoPieza')
                           ->setParameter('codigoPieza', $piezaTestigo);
                    }

                    return $qb;
                },
            ])
            ->add('statPrincipalNombre', ChoiceType::class, [
                'choices' => $opcionesStats, 
                'label' => 'Stat Principal', 
                'mapped' => false,

            ])
            ->add('statPrincipalValor', NumberType::class, ['label' => 'Valor', 'mapped' => false, 'html5' => true, 'attr' => ['step' => '0.1']]);

            for ($i = 1; $i <= 4; $i++) {
            $builder->add('subStatNombre' . $i, ChoiceType::class, [
                'choices' => self::STATS_HSR,
                'label' => 'Substat ' . $i,
                'placeholder' => 'Seleccionar...',
                'mapped' => false
            ]);
            
            $builder->add('subStatValor' . $i, NumberType::class, [
                'label' => 'Valor', 
                'required' => false,
                'mapped' => false, 
                'html5' => true, 
                'attr' => ['step' => '0.1']
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void 
    { 
        $resolver->setDefaults([
            'data_class' => Artefacto::class,
            'pieza_testigo' => null,
            'stat_fijo' => null
        ]);

        $resolver->setAllowedTypes('pieza_testigo', ['null', 'string']);
        $resolver->setAllowedTypes('stat_fijo', ['null', 'string']);
    }
}