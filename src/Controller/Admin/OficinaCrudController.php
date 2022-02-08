<?php

namespace App\Controller\Admin;

use App\Entity\Oficina;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use App\Controller\Admin\TextEditorField;
use App\Controller\Admin\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField as FieldTextField;
use Twig\Node\TextNode;

class OficinaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Oficina::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            FieldTextField::new('descripcion'),
            AssociationField::new("provincia"),
        ];
    }
    
}
