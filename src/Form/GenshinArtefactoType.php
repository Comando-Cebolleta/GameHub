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

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('setSeleccionado', EntityType::class, [
                'class' => SetArtefactos::class,
                'choice_label' => 'nombre',
                'label' => 'Set',
                'mapped' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('s')->where('s.juego = :j')->setParameter('j', 'Genshin')->orderBy('s.nombre', 'ASC');
                },
            ])
            ->add('statPrincipalNombre', ChoiceType::class, ['choices' => self::STATS_GENSHIN, 'label' => 'Stat Principal', 'mapped' => false])
            ->add('statPrincipalValor', NumberType::class, ['label' => 'Valor', 'mapped' => false, 'html5' => true, 'attr' => ['step' => '0.1']]);
    }

    public function configureOptions(OptionsResolver $resolver): void { $resolver->setDefaults(['data_class' => Artefacto::class]); }
}