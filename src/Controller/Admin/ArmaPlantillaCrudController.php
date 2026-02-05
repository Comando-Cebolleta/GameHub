<?php

namespace App\Controller\Admin;

use App\Entity\ArmaPlantilla;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class ArmaPlantillaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ArmaPlantilla::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('nombre'),
            ImageField::new('imagen')->setUploadDir('public/assets/armas')->setBasePath('assets/armas/'),
            TextField::new('juego'),
            TextField::new('pasiva'),
            TextField::new('tipo'),
        ];
    }
}
