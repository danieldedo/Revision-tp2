<?php

namespace App\Form;

use App\Entity\Livre;
use App\Entity\Emprunt;
use App\Entity\Etudiant;
use Doctrine\ORM\EntityRepository;
use App\Repository\LivreRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class EmpruntType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('dateemprunt')
            ->add('dateretourprevue', DateType::class, [
                'label' => 'date de retour prevue',
                'widget' => 'single_text',
             //'format' => 'yyyy-MM-dd',
            'attr' => ['class' => 'form-control']
        ])
            ->add('dateretoureffective', DateType::class, [
                'label' => 'date de retour effective',
                'required' => false,
                'widget' => 'single_text',
             //'format' => 'yyyy-MM-dd',
            'attr' => ['class' => 'form-control']
        ])
            ->add('livre', EntityType::class, [
                'placeholder' => 'Sélectionnez le livre',
                'class' => Livre::class,
                // 'query_builder' => function (EntityRepository $er) {
                //     return $er->createQueryBuilder('l')
                //         ->where('l.disponibilite = :disponibilite')
                //         ->setParameter('disponibilite', 'disponible');
                // },
                'choice_label' => 'titre',
                'attr' => ['class' => 'form-control'],
                'required' => true,
                'label' => 'Logement',
                'label_attr' => ['class' => 'form-label'],
            ])
            ->add('etudiant', EntityType::class, [
                'placeholder' => 'Sélectionnez l\'etudiant',
                'class' => Etudiant::class,
                'choice_label' => function (Etudiant $etudiant) {
                    return $etudiant->getPrenom() . ' ' . $etudiant->getNom();
                },
                'attr' => ['class' => 'form-control'],
                'required' => true,
                'label' => 'Etudiant',
                'label_attr' => ['class' => 'form-label'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Emprunt::class,
        ]);
    }
}
