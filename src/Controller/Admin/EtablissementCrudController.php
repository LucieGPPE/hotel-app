<?php

namespace App\Controller\Admin;

use App\Entity\Etablissement;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EtablissementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Etablissement::class;
    }
    public function configureCrud(Crud $crud):crud{
        return $crud
            ->setEntityLabelInSingular('Etablissement')
            ->setEntityLabelInPlural('Etablissement');
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            TextField::new('ville'),
            TextField::new('adresse'),
            TextEditorField::new('description'),
        ];
    }
    
}
