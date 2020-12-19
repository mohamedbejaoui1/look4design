<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\SousCategorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;



class SousCategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Nom de sous catégorie',
                ]
            ])
            ->add('categorie', EntityType::class, [
                'attr' => [

                    'class' => 'form-control ',
                    'id' => 'exampleFormControlSelect1',
                ],
                // looks for choices from this entity
                'class' => Categorie::class,
                'multiple' => false,
                'translation_domain' => 'Default',
                'required' => true
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'rows' => '4',
                    'placeholder' => 'Description de  sous  catégorie',
                ]
            ])
            ->add(
                'image',
                FileType::class,
                array('data_class' => null, 'required' => true, 'attr' => [
                    'onchange' => 'document.getElementById(\'output\').src = window.URL.createObjectURL(this.files[0])',
                    'accept' => 'image/*',
                    'class' => 'btn btn-danger col-12     waves-effect',

                ])
            );


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SousCategorie::class,
        ]);
    }
}
