<?php

namespace App\Form;

use App\Entity\Decouverte;
use App\Entity\Continent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Image;
//use App\EventSubscriber\Form\DecouverteFormSubscriber;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class DecouverteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
            	'constraints' => [
            		new NotBlank([
            		    'message' => "Le nom est obligatoire"
		            ])
	            ]
            ])
            ->add('description', TextareaType::class, [
	            'constraints' => [
		            new NotBlank([
                         'message' => "La description est obligatoire"
                     ])
                ]
            ])
    /*
            ->add('image', FileType::class, [
            	'data_class' => null, // permet d'indiquer qu'aucune classe ne va contenir les propriétés d'une image transférée
	            'constraints' => [
		            new NotBlank([
                         'message' => "L'image est obligatoire"
                    ]),
		            new Image([
		                'mimeTypes' => ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml'],
			            'mimeTypesMessage' => "L'image n'est pas dans un format Web"
		            ])
	            ]
            ])
    
            //->add('slug')

            /* 
             *champ en relation avec un entite
             *  utiliser EntityType comme type de champ
             *  class :cibler l'entite en relation
             *  choice_label : propriete de l'entite à afficher dans le champ 
            */
            ->add('continent', EntityType::class, [
                'class' => Continent::class,
                'choice_label' =>  'name',
                'placeholder' => '',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le continent est obligatoire'
                    ])
                ]
            ])
        ;
        
        //ajout d'un souscripteur de formulaire
    //  $builder->addEventSubscriber(new DecouverteFormSubscriber() );

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Decouverte::class,
        ]);
    }
}
