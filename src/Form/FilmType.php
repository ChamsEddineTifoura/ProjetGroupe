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
        $key = "2630e5d421793226b64f8e6f65bcf6e8";

        $json = file_get_contents("https://api.themoviedb.org/3/genre/movie/list?api_key=$key&language=fr");

        $result = json_decode($json, true);

        $genres = array();

        for ($i=0; $i < count($result["genres"]); $i++) { 
            $genres[] =  $result["genres"][$i]["name"];
        }

        $builder
            ->add('category', ChoiceType::class, [
                'choices'  => $genres, 
                'choice_label' => function ($genres, $key, $value) {
                    return $value;
                },
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
