<?php

namespace App\Controller\Admin;

use App\Entity\PersonajePlantilla;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;


class PersonajePlantillaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PersonajePlantilla::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('juego'),
            TextField::new('nombre'),
            // No creo que toquemos los JSON desde aquí, pero los dejamos por si acaso
            Field::new('statsBase')->hideOnIndex(),
            Field::new('statsPorNivel')->hideOnIndex(),
            
            ImageField::new('imagen')->setUploadDir('public/assets/personajes')->setBasePath('assets/personajes/'),
            ImageField::new('icono')->setUploadDir('public/assets/personajes')->setBasePath('assets/personajes/'),
            TextField::new('elemento'),
            TextField::new('senda'),
            TextField::new('tipoArma'),
        ];
    }
}
