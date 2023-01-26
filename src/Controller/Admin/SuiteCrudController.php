<?php

namespace App\Controller\Admin;

use App\Entity\Suite;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SuiteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Suite::class;
    }

    public function configureCrud(Crud $crud):crud{
        return $crud
            ->setEntityLabelInSingular('Etablissement')
            ->setEntityLabelInPlural('Etablissement');
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre'),
            ImageField::new('image') 
            ->setUploadDir('public/uploads/img/')
            ->setBasePath('uploads/img/'),
            TextEditorField::new('description'),
            NumberField::new('prix'),
            AssociationField::new('etablissement')
            
        ];
    }
    
}
