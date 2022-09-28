<?php

namespace App\Form;

use App\Entity\Ingredient;
use App\Entity\Recipe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Nom de la recette*',
                'required' => 'Le nom de la recette est obligatoire',
                'constraints' => [
                    new NotBlank(['message' => 'Ce champ est obligatoire.']),
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'Le champ nom doit comporter au maximum {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('picture', TextType::class)
            ->add('cookingTime', IntegerType::class, [
                'label' => 'Temps de préparation*',
                'required' => 'Veuillez indiquer un temps de préparation',
                'constraints' => [
                    new NotBlank(['message' => 'Ce champ est obligatoire.']),
                ],
            ])
            ->add('prepTime', IntegerType::class)
            ->add('restTime', IntegerType::class)
            ->add('steps', TextareaType::class)
            ->add('youtube', TextType::class)
            ->add('url', TextType::class)
            ->add('doc', TextType::class)
            ->add('book', TextType::class)
            ->add('page', IntegerType::class)
            ->add('vg', ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                ],
            ])
            ->add('servings', IntegerType::class)
            ->add('notes', TextareaType::class)
            ->add('type', ChoiceType::class)
            ->add('userlists')
            ->add('dishType', ChoiceType::class)
            ->add('recipeIngredients', EntityType::class, [
                'mapped' => true,
                'label' => 'Ingrédients',
                'placeholder' => 'Sélectionner...',
                'required' => false,
                'class' => Ingredient::class,
                'choice_label' => 'name',
                'multiple' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
