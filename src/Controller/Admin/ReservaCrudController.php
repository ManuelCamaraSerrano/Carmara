<?php

namespace App\Controller\Admin;

use App\Entity\Reserva;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class ReservaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reserva::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new("Usuario"),
            AssociationField::new("coche"),
            AssociationField::new("oficinadevolucion"),
            AssociationField::new("OficinaRecogida"),
            DateField::new('Fechaini'),
            DateField::new('Fechafin'),
            NumberField::new('PrecioTotal'),
        ];
    }
    
}
