<?php

namespace App\Form;

use App\Entity\Arma;
use App\Entity\ArmaPlantilla;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArmaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $juego = $options['juego'];

        $builder
            ->add('armaPlantilla', EntityType::class, [
                'class' => ArmaPlantilla::class,
                'choice_label' => 'nombre',
                'label' => 'Selecciona el Arma',
                'placeholder' => 'Elige un arma...',
                'attr' => ['class' => 'form-select arma-selector'], // Clase para JS
                'query_builder' => function (EntityRepository $er) use ($juego) {
                    // Aquí usamos la variable $juego para filtrar
                    $qb = $er->createQueryBuilder('a');
                    
                    if ($juego) {
                        $qb->where('a.juego = :juego')
                           ->setParameter('juego', $juego);
                    }
                    
                    return $qb->orderBy('a.nombre', 'ASC');
                },
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
            'data_class' => Arma::class,'juego' => null, 
        ]);
        
        // Indicamos que 'juego' puede ser string o null
        $resolver->setAllowedTypes('juego', ['null', 'string']);
    }
}