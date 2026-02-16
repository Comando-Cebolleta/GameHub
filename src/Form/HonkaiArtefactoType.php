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

    const SUBSTATS_PERMITIDOS = [
        'ATK', 'ATK%', 'DEF', 'DEF%', 'HP', 'HP%', 'CRIT_RATE', 'CRIT_DMG', 
        'SPD', 'EFFECT_HIT_RATE', 'EFFECT_RES', 'BREAK_EFFECT'
    ];

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $piezaTestigo = $options['pieza_testigo'];
        $tipoPieza = $options['tipo_pieza'];

        // Definir opciones para Main Stat según la pieza
        $choicesMain = self::STATS_HSR; // Por defecto todo
        
        // Filtrar opciones de Main Stat según el tipo de pieza
        switch ($tipoPieza) {
            case 'cabeza':
                $choicesMain = ['Vida (HP)' => 'HP'];
                break;
            case 'manos':
                $choicesMain = ['Ataque (ATK)' => 'ATK'];
                break;
            case 'torso':
                $allow = ['ATK%', 'DEF%', 'HP%', 'EFFECT_HIT_RATE', 'HEAL_BONUS', 'CRIT_RATE', 'CRIT_DMG'];
                $choicesMain = array_filter(self::STATS_HSR, fn($v) => in_array($v, $allow));
                break;
            case 'pies':
                $allow = ['ATK%', 'DEF%', 'HP%', 'SPD'];
                $choicesMain = array_filter(self::STATS_HSR, fn($v) => in_array($v, $allow));
                break;
            case 'esfera':
                $allow = ['ATK%', 'DEF%', 'HP%', 'PHYSICAL_DMG_BONUS', 'FIRE_DMG_BONUS', 
                          'ICE_DMG_BONUS', 'LIGHTNING_DMG_BONUS', 'WIND_DMG_BONUS', 
                          'QUANTUM_DMG_BONUS', 'IMAGINARY_DMG_BONUS'];
                $choicesMain = array_filter(self::STATS_HSR, fn($v) => in_array($v, $allow));
                break;
            case 'cuerda':
                $allow = ['ATK%', 'DEF%', 'HP%', 'BREAK_EFFECT', 'ER'];
                $choicesMain = array_filter(self::STATS_HSR, fn($v) => in_array($v, $allow));
                break;
        }

        // Definir opciones para Substats
        $choicesSubs = array_filter(self::STATS_HSR, fn($v) => in_array($v, self::SUBSTATS_PERMITIDOS));

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
                        $qb->join('s.artefactoPlantillas', 'p') 
                           ->join('p.piezaTipo', 'pt')
                           ->andWhere('pt.codigo = :codigoPieza')
                           ->setParameter('codigoPieza', $piezaTestigo);
                    }
                    return $qb;
                },
            ])
            ->add('statPrincipalNombre', ChoiceType::class, [
                'choices' => $choicesMain, 
                'label' => 'Stat Principal', 
                'mapped' => false,
                'attr' => ['class' => 'main-stat-select'] // Clase para JS
            ])
            ->add('statPrincipalValor', NumberType::class, ['label' => 'Valor', 'mapped' => false, 'html5' => true, 'attr' => ['step' => '0.1']]);

        for ($i = 1; $i <= 4; $i++) {
            $builder->add('subStatNombre' . $i, ChoiceType::class, [
                'choices' => $choicesSubs,
                'label' => 'Substat ' . $i,
                'placeholder' => 'Seleccionar...',
                'mapped' => false,
                'required' => false,
                'attr' => ['class' => 'sub-stat-select'] // Clase para JS
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
            'tipo_pieza' => null,
            'stat_fijo' => null
        ]);

        $resolver->setAllowedTypes('pieza_testigo', ['null', 'string']);
        $resolver->setAllowedTypes('tipo_pieza', ['null', 'string']);
        $resolver->setAllowedTypes('stat_fijo', ['null', 'string']);
    }
}