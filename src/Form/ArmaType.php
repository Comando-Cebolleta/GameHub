<?php

namespace App\Form;

use App\Entity\Arma;
use App\Entity\ArmaPlantilla;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArmaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('armaPlantilla', EntityType::class, [
                'class' => ArmaPlantilla::class,
                'choice_label' => 'nombre',
                'label' => 'Selecciona el Arma',
                'placeholder' => 'Elige un arma...',
                'attr' => ['class' => 'form-select arma-selector'], // Clase para JS
            ])
            ->add('nivel', IntegerType::class, [
                'label' => 'Nivel del arma',
                'attr' => ['min' => 1, 'max' => 90, 'class' => 'form-control'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Arma::class,
        ]);
    }
}