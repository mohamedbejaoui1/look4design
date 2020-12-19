<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Produit;
use App\Entity\SousCategorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Nom de produit',
                ]
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'rows' => '4',
                    'placeholder' => 'Description de produit',
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
            ->add('prix', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'prix',
                ]
            ])
            ->add('disponibilite', CheckboxType::class, [
                'attr' => [
                    'class' => '',
                ],
                'required' => false
            ])
            ->add('ProduitAccueil', CheckboxType::class, [
                'attr' => [
                    'class' => '',
                ],
                'required' => false
            ])


            ->add('reference', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'reference de produit',
                ]
            ])
            ->add('categorie', EntityType::class, [
                'attr' => [

                    'class' => 'form-control col-12',
                    'id' => 'exampleFormControlSelect1',
                ],
                // looks for choices from this entity
                'class' => Categorie::class,
                'multiple' => false,
                'translation_domain' => 'Default',
                'required' => false
            ])
            ->add('sous_categorie', EntityType::class, [
                'attr' => [

                    'class' => 'form-control  col-12',
                    'id' => 'exampleFormControlSelect1',
                ],
                // looks for choices from this entity
                'class' => SousCategorie::class,
                'multiple' => false,
                'translation_domain' => 'Default',
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
