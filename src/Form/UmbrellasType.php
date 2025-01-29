<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Umbrella;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UmbrellasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class,[
			"label"=>"Titre"
		  ])
            ->add('description',TextareaType::class,[
			"label"=>"Description"
		  ])
            ->add('estimate')
            ->add('characteristic',TextType::class,[
			"label"=>"Caractéristique spécifique : "
		  ])
		  ->add("category",EntityType::class, [
			'choice_label' => 'Category',
			"class"=>Category::class,
			"label"=>"Catégorie :",
			'multiple'=>false,
			'expanded'=>true,
			])
		  ->add('imageFile', FileType::class,[ //Champ de fichier
			"mapped"=>True,
			"required"=>False,
			"label"=>"Image",
			'constraints' => [
			    new File([
				   'maxSize' => '2M', //Ajout de contrainte (Optionnel)
				   'mimeTypes' => [
					  'image/jpeg',
					  'image/jpg',
					  'image/png',
					  'image/webp',
				   ],
				   'mimeTypesMessage' => 'Veuillez télécharger un fichier au format JPEG, JPG, PNG ou WEBP.'
			    ])
			]
		 ])

        ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Umbrella::class,
        ]);
    }
}
