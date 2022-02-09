<?php

namespace App\Controller\Admin;

use App\Entity\Fotos;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class FotosCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Fotos::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            ImageField::new('foto')->setBasePath('img')->setUploadDir("img"),
            AssociationField::new("coche"),
        ];
    }
    
}
