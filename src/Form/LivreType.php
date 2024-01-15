<?php

namespace App\Form;

use App\Entity\Livre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre',TextType::class , [
                'attr' => ['class' => 'form-control',],
                'label' => 'Titre',
                'label_attr' => ['class' => 'form-label mt-4'],
            ])
            ->add('auteur',TextType::class , [
                'attr' => ['class' => 'form-control',],
                'label' => 'Auteur',
                'label_attr' => ['class' => 'form-label mt-4'],
            ])
            ->add('resume',TextType::class , [
                'attr' => ['class' => 'form-control',],
                'label' => 'Resumé',
                'label_attr' => ['class' => 'form-label mt-4'],
            ])
            ->add('disponibilite',ChoiceType::class , [
                'choices' => [
                    'Disponible'=> 'Disponible',
                    'Emprunté' => 'Emprunté'
                ],
                'expanded' => true,
                'multiple' => false,
                'label' => 'Disponibilite:',
                'attr' => ['class' => 'form-check-input',],
                'label_attr' => ['class' => 'form-label mt-4'],
            ])
            ->add('localisation',TextType::class , [
                'attr' => ['class' => 'form-control',],
                'label' => 'Localisation',
                'label_attr' => ['class' => 'form-label mt-4'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
