<?php

namespace App\Controller\Admin;

use App\Entity\SetArtefactos;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use App\Form\EfectoEntryType;

class SetArtefactosCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SetArtefactos::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('nombre'),
            TextField::new('juego'),
            // Mostrar JSON crudo en la vista detalle/listado
            TextEditorField::new('efectos')->onlyOnDetail(),
            // Interfaz amigable para editar los efectos: colección de entradas {piezas, descripcion}
            CollectionField::new('efectosForm')
                ->setEntryType(EfectoEntryType::class)
                ->allowAdd()
                ->allowDelete()
                ->onlyOnForms(),
        ];
    }
}
