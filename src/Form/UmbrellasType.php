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

class UmbrellasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('estimate')
            ->add('characteristic')
		  ->add("category",EntityType::class, [
			"class"=>Category::class,
			'choice_label' => 'category',
			'multiple'=>false,
			'expanded'=>true,
			])
		  ->add('imageFile', FileType::class,[ //Champ de fichier
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
