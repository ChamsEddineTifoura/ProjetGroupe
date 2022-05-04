<?php

namespace App\Form;

use App\Entity\Film;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class FilmType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        //Recuperation du tableau Category
        //----------------------------------------------------------------------------------
        $key = "2630e5d421793226b64f8e6f65bcf6e8";
        $json = file_get_contents("https://api.themoviedb.org/3/genre/movie/list?api_key=$key&language=fr");
        $result = json_decode($json, true);
        $genres = $result;
        //----------------------------------------------------------------------------------

        $builder

            ->add('category', ChoiceType::class, [
                'choices'  => [
                    $genres['genres'][0]['name'] => $genres['genres'][0]['name'],
                    $genres['genres'][1]['name'] => $genres['genres'][1]['name'],
                    $genres['genres'][2]['name'] => $genres['genres'][2]['name'],
                ], 
            ])
            ->add('name', ChoiceType::class, [
                'choices'  => [
                    'Le seigneur des Anneaux' => 'Le seigneur des Anneaux',
                    'Star Wars' => 'Star Wars',
                    'Taxi' => 'Taxi',
                ],
            ])
            ->add('synopsis', TextType::class)
            ->add('image', TextType::class)
            ->add('submit', SubmitType::class, [
                'label' => "Enregistrer le film"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Film::class,
        ]);
    }
}
