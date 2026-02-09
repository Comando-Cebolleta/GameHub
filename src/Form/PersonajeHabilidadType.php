<?php

namespace App\Form;

use App\Entity\PersonajeHabilidad;
use App\Entity\Habilidad;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonajeHabilidadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('habilidad', EntityType::class, [
                'class' => Habilidad::class,
                'choice_label' => 'nombre',
                'attr' => ['class' => 'd-none'], // Ocultamos el select porque lo gestionaremos via JS
                'label' => false,
            ])
            ->add('nivel', IntegerType::class, [
                'label' => false,
                'attr' => ['class' => 'form-control', 'min' => 1, 'max' => 10, 'placeholder' => 'Nivel']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PersonajeHabilidad::class,
        ]);
    }
}
