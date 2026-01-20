<?php

namespace App\Form;

use App\Entity\Personaje;
use App\Form\HonkaiArtefactoType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HonkaiBuildType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class, ['label' => 'Nombre de tu Build', 'attr' => ['placeholder' => 'Ej: Kafka DoT']])
            ->add('personajePlantilla', EntityType::class, [
                'class' => \App\Entity\PersonajePlantilla::class,
                'choice_label' => 'nombre',
                'label' => 'Personaje',
                'placeholder' => 'Selecciona personaje...',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('p')->where('p.senda IS NOT NULL')->orderBy('p.nombre', 'ASC');
                },
            ])
            // Si en el futuro tienes entidad ConoDeLuz, añádela aquí similar a Arma
            ->add('reliquia_cabeza', HonkaiArtefactoType::class, ['label' => 'Cabeza', 'mapped' => false])
            ->add('reliquia_manos', HonkaiArtefactoType::class, ['label' => 'Manos', 'mapped' => false])
            ->add('reliquia_torso', HonkaiArtefactoType::class, ['label' => 'Torso', 'mapped' => false])
            ->add('reliquia_pies', HonkaiArtefactoType::class, ['label' => 'Pies', 'mapped' => false])
            ->add('ornamento_esfera', HonkaiArtefactoType::class, ['label' => 'Esfera', 'mapped' => false])
            ->add('ornamento_cuerda', HonkaiArtefactoType::class, ['label' => 'Cuerda', 'mapped' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void { $resolver->setDefaults(['data_class' => Personaje::class]); }
}