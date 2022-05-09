<?php

namespace App\Form;

use App\Entity\Film;
use App\Entity\Genre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class FilmType extends AbstractType
{   
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $key = "2630e5d421793226b64f8e6f65bcf6e8";
        $json = file_get_contents("https://api.themoviedb.org/3/genre/movie/list?api_key=$key&language=fr");
        $result = json_decode($json, true);

        $genres = array();

        for ($i=0; $i < count($result["genres"]); $i++) { 
            $genre = new Genre();
            $genre->setId($result["genres"][$i]['id']);
            $genre->setName($result["genres"][$i]['name']);
            $genres[] = $genre;
        }

        $json2 = file_get_contents("https://api.themoviedb.org/3/genre/movie/list?api_key=$key&language=fr");
        $result2 = json_decode($json2, true);
        
        //dd($genres);
        $builder
            ->add('category', ChoiceType::class, [
                'choices'  => $genres, 
                'choice_value' => 'id',
                'choice_label' => function(?Genre $genre) {
                    return $genre ? $genre->getName() : '';
                },
            ])
            ->add('name', ChoiceType::class, [
                'choices'  => [],
                'choice_value' => 'id',
            ])
            // ->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event){
            //     $test = $event->getData();
            //     dd($test);
            // })
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
