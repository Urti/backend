<?php

namespace App\Type;

use App\Entity\Group;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
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
            ->add('login', TextType::class)
            ->add('last_name', TextType::class)
            ->add('first_name', TextType::class)
            ->add('updatedat', ChoiceType::class, [
                'choices' => ['now' => new \DateTime('now'),],
                'attr' => array('style' => 'display:none;'),
                'label' => ' '
            ])
            ->add('group', EntityType::class, [
                'required' => false,
                'placeholder' => 'Wybierz Grupę',
                'class' => Group::class,
                'choice_label' => 'name',
                'label' => 'Grupa: '
            ])
            ->add('save', SubmitType::class, ['label' => 'Zapisz', 'attr' => array('class' => 'btn btn-success')]);
    }
}