<?php

namespace App\Form;

use App\Entity\Film;
use App\Entity\Genre;
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
        // $key = "2630e5d421793226b64f8e6f65bcf6e8";
        // $json = file_get_contents("https://api.themoviedb.org/3/genre/movie/list?api_key=$key&language=fr");
        // $result = json_decode($json, true);

        // $genres = array();

        // for ($i=0; $i < count($result["genres"]); $i++) { 
        //     $genre = new Genre();
        //     $genre->setId($result["genres"][$i]['id']);
        //     $genre->setName($result["genres"][$i]['name']);
        //     $genres[] = $genre;
        // }
        //dd($genres);
        $builder
            // ->add('category', ChoiceType::class, [
            //     'placeholder' => 'Choisissez une catégorie',
            //     'choices'  => $genres, 
            //     'choice_value' => 'id',
            //     'choice_label' => function(?Genre $genre) {
            //         return $genre ? $genre->getName() : '';
            //     },
            // ])
            ->add('name', TextType::class, [
                'label'  => 'Rechercher un film',
            ])
            ->add('category', TextType::class)
            ->add('synopsis', TextType::class, [
                'attr' => [
                    'maxlength' => 255,
                ],
            ])
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
