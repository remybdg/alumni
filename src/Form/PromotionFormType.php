<?php

namespace App\Form;

use App\Entity\Degree;
use App\Entity\Promotion;
use App\Entity\Year;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PromotionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('degree',EntityType::class, [
                'label' => 'Formation associée',
                'class' => Degree::class,
                'choice_label' => 'name'
            ])
            ->add('year',EntityType::class, [
                'label' => 'Année associée',
                'class' => Year::class,
                'choice_label' => 'title'
            ])
            ->add('startDate',      DateType::class, [


            ])

            ->add('endDate',      DateType::class, [


            ])
            ->add('notes',TextareaType::class, [

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Promotion::class,
        ]);
    }
}
