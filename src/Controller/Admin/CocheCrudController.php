<?php

namespace App\Controller\Admin;

use App\Entity\Coche;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CocheCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Coche::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
