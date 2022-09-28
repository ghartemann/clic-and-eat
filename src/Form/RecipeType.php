<?php

namespace App\Form;

use App\Entity\Dish;
use App\Entity\IngredientRecipe;
use App\Entity\Recipe;
use App\Entity\Type;
use App\Entity\Userlist;
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
            ->add('picture', TextType::class, [
                'label' => 'Lien vers une image',
            ])
            ->add('cookingTime', IntegerType::class, [
                'label' => 'Temps de cuisson*',
                'required' => 'Veuillez indiquer un temps de cuisson',
                'constraints' => [
                    new NotBlank(['message' => 'Ce champ est obligatoire.']),
                ],
            ])
            ->add('prepTime', IntegerType::class, [
                'label' => 'Temps de préparation*',
                'required' => 'Veuillez indiquer un temps de préparation',
                'constraints' => [
                    new NotBlank(['message' => 'Ce champ est obligatoire.']),
                ],
            ])
            ->add('restTime', IntegerType::class, [
                'label' => 'Temps de repos*',
                'required' => 'Veuillez indiquer un temps de repos',
                'constraints' => [
                    new NotBlank(['message' => 'Ce champ est obligatoire.']),
                ],
            ])
            ->add('steps', TextareaType::class, [
                'label' => 'Étapes* (séparées par un slash, sans numéro)',
                'required' => 'Veuillez indiquer les étapes',
                'constraints' => [
                    new NotBlank(['message' => 'Ce champ est obligatoire.']),
                ],
            ])
            ->add('youtube', TextType::class, [
                'label' => 'Lien Youtube',
                'required' => false,
            ])
            ->add('url', TextType::class, [
                'label' => 'Lien vers la recette',
                'required' => false,
            ])
            ->add('doc', TextType::class, [
                'label' => 'Lien vers un document',
                'required' => false,
            ])
            ->add('book', TextType::class, [
                'label' => 'Livre de recettes',
                'required' => false,
            ])
            ->add('page', IntegerType::class, [
                'label' => 'Page du livre',
                'required' => false,
            ])
            ->add('vg', ChoiceType::class, [
                'label' => 'Végétarien',
                'required' => true,
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                ],
            ])
            ->add('servings', IntegerType::class, [
                'label' => 'Nombre de parts',
                'required' => true,
            ])
            ->add('notes', TextareaType::class, [
                'required' => false,
            ])
            ->add('type', EntityType::class, [
                'label' => 'Type de plat',
                'required' => true,
                'class' => Type::class,
                'choice_label' => 'type',
                'expanded' => true,
            ])
            // TODO: later
//            ->add('userlists', EntityType::class, [
//                'label' => 'Ajouter à une liste',
//                'class' => Userlist::class,
//                'choice_label' => 'name',
//                'expanded' => true,
//            ])
            ->add('dishType', EntityType::class, [
                'label' => 'Type de plat',
                'class' => Dish::class,
                'required' => true,
                'choice_label' => 'name',
                'expanded' => true,
            ])
            // TODO: doesn't work (quantity)
            ->add('recipeIngredients', EntityType::class, [
                'label' => 'Ingrédients',
                'class' => IngredientRecipe::class,
                'choice_label' => function ($ingredient) {
                    return $ingredient->getIngredient()->getName();
                },
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
