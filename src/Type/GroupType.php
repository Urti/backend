<?php

namespace App\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class GroupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $check_builder = $builder->getData()->getcreatedat();

        if (is_null($check_builder)) {
            $checkin =  $builder->add('createdat', ChoiceType::class, [
                'choices' => ['now' => new \DateTime('now'),],
                'attr' => array('style' => 'display:none;'),
                'label' => ' '
            ]);
        }
        $builder
            ->add('name', TextType::class, ['label' => 'Nazwa: '])
            ->add('info', TextType::class, ['label' => 'Informacja: '])
            ->add('updatedat', ChoiceType::class, [
                'choices' => ['now' => new \DateTime('now'),],
                'attr' => array('style' => 'display:none;'),
                'label' => ' '
            ])
            ->add('save', SubmitType::class, ['label' => 'Dodaj', 'attr' => array('class' => 'btn btn-success')]);
    }
}