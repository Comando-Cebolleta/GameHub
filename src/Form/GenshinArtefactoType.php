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

class GenshinArtefactoType extends AbstractType
{
    const STATS_GENSHIN = [
        'Vida (HP)' => 'HP', 'Vida %' => 'HP%', 'Ataque (ATK)' => 'ATK', 'Ataque %' => 'ATK%',
        'Defensa (DEF)' => 'DEF', 'Defensa %' => 'DEF%', 'Maestría Elemental' => 'EM',
        'Recarga de Energía' => 'ER', 'Bono Daño Pyro' => 'PYRO_DMG_BONUS',
        'Bono Daño Hydro' => 'HYDRO_DMG_BONUS', 'Bono Daño Geo' => 'GEO_DMG_BONUS',
        'Bono Daño Dendro' => 'DENDRO_DMG_BONUS', 'Bono Daño Electro' => 'ELECTRO_DMG_BONUS',
        'Bono Daño Anemo' => 'ANEMO_DMG_BONUS', 'Bono Daño Cryo' => 'CRYO_DMG_BONUS',
        'Prob. Crítico' => 'CRIT_RATE', 'Daño Crítico' => 'CRIT_DMG', 'Bono Curación' => 'HEAL_BONUS',
    ];

    const SUBSTATS_PERMITIDOS = [
        'ATK', 'ATK%', 'DEF', 'DEF%', 'HP', 'HP%', 'EM', 'ER', 'CRIT_RATE', 'CRIT_DMG'
    ];

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $tipoPieza = $options['tipo_pieza'];
        
        // Definir opciones para Main Stat según la pieza
        $choicesMain = self::STATS_GENSHIN; // Por defecto todo
        
        // Filtrar opciones de Main Stat según el tipo de pieza
        switch ($tipoPieza) {
            case 'flor':
                $choicesMain = ['Vida (HP)' => 'HP'];
                break;
            case 'pluma':
                $choicesMain = ['Ataque (ATK)' => 'ATK'];
                break;
            case 'reloj':
                $allow = ['ATK%', 'DEF%', 'HP%', 'EM', 'ER'];
                $choicesMain = array_filter(self::STATS_GENSHIN, fn($v) => in_array($v, $allow));
                break;
            case 'copa':
                $allow = ['ATK%', 'DEF%', 'HP%', 'EM', 'PYRO_DMG_BONUS', 'HYDRO_DMG_BONUS', 
                          'GEO_DMG_BONUS', 'DENDRO_DMG_BONUS', 'ELECTRO_DMG_BONUS', 
                          'ANEMO_DMG_BONUS', 'CRYO_DMG_BONUS'];
                $choicesMain = array_filter(self::STATS_GENSHIN, fn($v) => in_array($v, $allow));
                break;
            case 'casco':
                $allow = ['ATK%', 'DEF%', 'HP%', 'EM', 'HEAL_BONUS', 'CRIT_RATE', 'CRIT_DMG'];
                $choicesMain = array_filter(self::STATS_GENSHIN, fn($v) => in_array($v, $allow));
                break;
        }

        // Definir opciones para Substats
        $choicesSubs = array_filter(self::STATS_GENSHIN, fn($v) => in_array($v, self::SUBSTATS_PERMITIDOS));

        $builder
            ->add('setSeleccionado', EntityType::class, [
                'class' => SetArtefactos::class,
                'choice_label' => 'nombre',
                'label' => 'Set',
                'placeholder' => 'Seleccionar...',
                'mapped' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('s')->where('s.juego = :j')->setParameter('j', 'Genshin')->orderBy('s.nombre', 'ASC');
                },
                'attr' => ['class' => 'artefacto-set-select']
            ])
            ->add('statPrincipalNombre', ChoiceType::class, [
                'choices' => $choicesMain, 
                'label' => 'Stat Principal', 
                'mapped' => false,
                'attr' => ['class' => 'main-stat-select']
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
            'tipo_pieza' => null,
            'stat_fijo' => null
        ]); 

        $resolver->setAllowedTypes('tipo_pieza', ['null', 'string']);
    }
}