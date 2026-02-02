<?php

namespace App\Form;

use App\Entity\Personaje;
use App\Form\HonkaiArtefactoType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HonkaiBuildType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Definimos los testigos. 
        // Cualquier set que tenga una "Cabeza" es un set de 4 piezas.
        // Cualquier set que tenga una "Esfera" es un set de 2 piezas.
        $filtroReliquia = 'Cabeza'; 
        $filtroOrnamento = 'Esfera';

        $builder
            ->add('nombre', TextType::class, ['label' => 'Nombre de tu Build', 'attr' => ['placeholder' => 'Ej: Kafka DoT']])

            ->add('personajePlantilla', EntityType::class, [
                'class' => \App\Entity\PersonajePlantilla::class,
                'choice_label' => 'nombre',
                'label' => 'Personaje',
                'placeholder' => 'Selecciona personaje...',
                'attr' => ['class' => 'form-select personaje-selector'],
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('p')->where('p.senda IS NOT NULL')->orderBy('p.nombre', 'ASC');
                },
            ])
            ->add('nivel', IntegerType::class, [
                'label' => 'Nivel',
                'attr' => ['min' => 1, 'max' => 80, 'class' => 'form-control'],
            ])
            ->add('dupeNum', IntegerType::class, [
                'label' => 'Eidolones',
                'attr' => ['min' => 0, 'max' => 6, 'class' => 'form-control'],
            ])

            ->add('arma', ArmaType::class, [
                'label' => 'Cono de Luz',
                'required' => true,
                'juego' => 'hsr',
            ])

            // --- RELIQUIAS (Sets de Caverna) ---
            // Usamos 'Cabeza' como filtro para todos, porque todos comparten los mismos sets
            ->add('reliquia_cabeza', HonkaiArtefactoType::class, [
                'label' => 'Cabeza', 'mapped' => false,
                'pieza_testigo' => $filtroReliquia,
                'stat_fijo' => 'HP'
            ])
            ->add('reliquia_manos', HonkaiArtefactoType::class, [
                'label' => 'Manos', 'mapped' => false,
                'pieza_testigo' => $filtroReliquia,
                'stat_fijo' => 'ATK'
            ])

            ->add('reliquia_torso', HonkaiArtefactoType::class, [
                'label' => 'Torso', 'mapped' => false,
                'pieza_testigo' => $filtroReliquia
            ])
            ->add('reliquia_pies', HonkaiArtefactoType::class, [
                'label' => 'Pies', 'mapped' => false,
                'pieza_testigo' => $filtroReliquia
            ])

            // --- ORNAMENTOS (Sets Planares) ---
            // Lo mismo que con las reliquias
            ->add('ornamento_esfera', HonkaiArtefactoType::class, [
                'label' => 'Esfera', 'mapped' => false,
                'pieza_testigo' => $filtroOrnamento
            ])
            ->add('ornamento_cuerda', HonkaiArtefactoType::class, [
                'label' => 'Cuerda', 'mapped' => false,
                'pieza_testigo' => $filtroOrnamento
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void { $resolver->setDefaults(['data_class' => Personaje::class]); }
}