<?php

namespace App\Controller\Admin;

use App\Entity\ArtefactoPlantilla;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class ArtefactoPlantillaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ArtefactoPlantilla::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            AssociationField::new('piezaTipo'),
            AssociationField::new('setArtefactos'),
            ImageField::new('imagen')->setUploadDir('public/assets/artefactos')->setBasePath('assets/artefactos/'),
            TextField::new('juego'),
        ];
    }
}
