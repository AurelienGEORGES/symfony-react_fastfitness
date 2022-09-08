<?php

namespace App\Controller\Admin;

use App\Entity\ReservationCoach;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ReservationCoachCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ReservationCoach::class;
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
