<?php

namespace App\Controller\Admin;

use App\Entity\Usuario;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField as FieldTextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;



class UsuarioCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Usuario::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            FieldTextField::new('Dni'),
            EmailField::new('email'),
            FieldTextField::new('Nombre'),
            FieldTextField::new('Apellidos'),
            FieldTextField::new('Telefono'),
            ImageField::new('foto')->setBasePath('public/estilos/images')->setUploadDir("public/estilos/images"),
            
        ];
    }

    
    
}
