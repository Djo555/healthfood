<?php


namespace App\Controller\Admin;


use App\Entity\Product;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

use Vich\UploaderBundle\Form\Type\VichImageType;

use EasyCorp\Bundle\EasyAdminBundle\Field\Field;


class ProductCrudController extends AbstractCrudController

{

    public static function getEntityFqcn(): string

    {

        return Product::class;

    }


    

    public function configureFields(string $pageName): iterable

    {

        return [

            IdField::new('id')->onlyOnIndex(),

            TextField::new('name'),

            TextEditorField::new('description'),

            NumberField::new('price'),

            DateTimeField::new('createdAt')->setFormTypeOptions([

                'html5' => true,

                'widget' => 'single_text',

            ]),

            TextField::new('image1')->onlyOnIndex(),

            TextField::new('image2')->onlyOnIndex(),

            Field::new('image1File')

                ->setFormType(VichImageType::class)

                ->onlyOnForms(),

            Field::new('image2File')

                ->setFormType(VichImageType::class)

                ->onlyOnForms(),


        ];

    }

}