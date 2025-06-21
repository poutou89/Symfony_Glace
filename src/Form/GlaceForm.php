<?php

namespace App\Form;

use App\Entity\cornet;
use App\Entity\Toppings;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class GlaceForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('Supp')
            ->add('cornet', EntityType::class, [
                'class' => cornet::class,
                'choice_label' => 'nom', // Ce qui s'affiche dans le <select>
            ])
            ->add('toppings', EntityType::class, [
            'class' => Toppings::class,
            'choice_label' => 'nom', // champ à afficher pour chaque checkbox
            'multiple' => true,
            'expanded' => true, // ← cochez "true" pour afficher en checkboxes
            ])
            
            ->add('imageFile', FileType::class, [ 
                'required' => false, 
                'mapped' => true, 
                'constraints' => [
                    new File([
                        'maxSize' => '2M', 
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png', 
                            'image/gif',
                ],
                'mimeTypesMessage' => 'Veuillez uploader une image valide (JPEG, PNG, GIF).',
            ])
            
            ],
        
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
