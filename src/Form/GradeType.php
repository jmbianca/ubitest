<?php


namespace App\Form;


use App\Entity\Matter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class GradeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matter', EntityType::class, [
                'label' => 'Matière',
                'class' => Matter::class
            ])
            ->add('note', TextType::class, [
                'label' => 'Note',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Ajouter la note',
            ])
        ;
    }
}