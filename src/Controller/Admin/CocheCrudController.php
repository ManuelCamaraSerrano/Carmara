<?php

namespace App\Controller\Admin;


use App\Entity\Coche;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField as FieldTextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
class CocheCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Coche::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new("marca"),
            AssociationField::new("oficina"),
            FieldTextField::new('Matricula'),
            FieldTextField::new('Modelo'),
            NumberField::new('Npuertas'),
            ChoiceField::new('cambio')->setChoices([
                'Manual' => 'Manual',
                'Automatico' => 'Automatico',
            ]),
            NumberField::new('cv'),
            NumberField::new('precio'),
            ChoiceField::new('tipo')->setChoices([
                '4X4' => '4X4',
                'Berlina' => 'Berlina',
                'Deportivo' => 'Deportivo',
                'Familiar' => 'Familiar',
                'Compactos' => 'Compactos',
            ]),
            FieldTextField::new('color'),

        ];
    }
    
}
