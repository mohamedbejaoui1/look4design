<?php

namespace App\Form;

use App\Entity\Categorie;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Nom de catégorie',
                ]
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'rows' => '4',
                    'placeholder' => 'Description de catégorie',
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
            )
            ->add('important', CheckboxType::class, [
                'attr' => [
                    'class' => '',
                ],
                'required' => false
            ])
        ;


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class,
        ]);
    }
}
