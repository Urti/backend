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
        $builder
            ->add('name', TextType::class, ['label' => 'Nazwa'])
            ->add('info', TextType::class, [
                'label' => 'Informacja',
                'required' => false
            ])
            ->add('save', SubmitType::class, ['label' => 'Zapisz', 'attr' => array('class' => 'btn btn-success btn-sm btn-block mt-3')])
            ->add('updatedat', ChoiceType::class, [
                'choices' => ['now' => new \DateTime('now'),],
                'attr' => array('style' => 'display:none;'),
                'label' => ' '
            ]);

        $check_builder = $builder->getData()->getcreatedat();
        if (is_null($check_builder)) {
            $checkin =  $builder->add('createdat', ChoiceType::class, [
                'choices' => ['now' => new \DateTime('now'),],
                'attr' => array('style' => 'display:none;'),
                'label' => ' '
            ]);
        }
    }
}