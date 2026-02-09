<?php

namespace App\Form;

use App\Entity\Personaje;
use App\Entity\Arma;
use App\Form\ArmaType;
use App\Form\GenshinArtefactoType;
use App\Form\PersonajeHabilidadType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GenshinBuildType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class, ['label' => 'Nombre de tu Build', 'attr' => ['placeholder' => 'Ej: Hu Tao Vaporizados']])

            ->add('personajePlantilla', EntityType::class, [
                'class' => \App\Entity\PersonajePlantilla::class,
                'choice_label' => 'nombre',
                'label' => 'Personaje',
                'placeholder' => 'Selecciona personaje...',
                'attr' => ['class' => 'form-select personaje-selector'],
                'query_builder' => function (EntityRepository $er) {
                    // Para mirar si el pj es de Genshin, miramos si el campo senda es null
                    // porque los de Genshin no tienen
                    return $er->createQueryBuilder('p')->where('p.senda IS NULL')->orderBy('p.nombre', 'ASC');
                },
                'choice_attr' => function ($personajePlantilla) {
                    return ['data-tipo-arma' => $personajePlantilla->getTipoArma()];
                },
                'disabled' => $options['is_edit']
            ])
            ->add('nivel', IntegerType::class, [
                'label' => 'Nivel',
                'attr' => ['min' => 1, 'max' => 90, 'class' => 'form-control'],
            ])
            ->add('dupeNum', IntegerType::class, [
                'label' => 'Constelaciones',
                'attr' => ['min' => 0, 'max' => 6, 'class' => 'form-control'],
            ])

            ->add('arma', ArmaType::class, [
                'label' => 'Arma',
                'required' => true,
                'juego' => 'Genshin',
            ])

            ->add('artefacto_flor', GenshinArtefactoType::class, [
                'label' => 'Flor',
                'mapped' => false,
                'stat_fijo' => 'HP'
            ])
            ->add('artefacto_pluma', GenshinArtefactoType::class, [
                'label' => 'Pluma',
                'mapped' => false,
                'stat_fijo' => 'ATK'
            ])

            ->add('artefacto_reloj', GenshinArtefactoType::class, ['label' => 'Reloj', 'mapped' => false])
            ->add('artefacto_copa', GenshinArtefactoType::class, ['label' => 'Cáliz', 'mapped' => false])
            ->add('artefacto_casco', GenshinArtefactoType::class, ['label' => 'Casco', 'mapped' => false])
            ->add('personajeHabilidades', \Symfony\Component\Form\Extension\Core\Type\CollectionType::class, [
                'entry_type' => PersonajeHabilidadType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void 
    { 
        $resolver->setDefaults([
            'data_class' => Personaje::class, 
            'is_edit' => false
        ]); 

        $resolver->setAllowedTypes('is_edit', 'bool');
    }
}