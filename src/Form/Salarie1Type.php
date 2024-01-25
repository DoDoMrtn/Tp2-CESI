<?php

namespace App\Form;

use App\Entity\Salarie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Salarie1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Id')
            ->add('Nom')
            ->add('Prenom')
            ->add('Adresse')
            ->add('Tel')
            ->add('Matricule')
            ->add('Departement')
            ->add('Poste')
            ->add('Salaire')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Salarie::class,
        ]);
    }
}
