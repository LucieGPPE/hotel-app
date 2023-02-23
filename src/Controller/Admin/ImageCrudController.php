<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class ImageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Image::class;
    }

    public function configureCrud(Crud $crud):crud{
        return $crud
            ->setEntityLabelInSingular('Image')
            ->setEntityLabelInPlural('Images');
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            ImageField::new('url')->setUploadDir('/public/uploads/img/')
                                ->setBasePath('uploads/img/'),
            TextEditorField::new('description'),
            AssociationField::new('suite_id')
        ];
    }
    
}
