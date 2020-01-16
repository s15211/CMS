<?php


namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('srchText',null,array('label' => false))
            ->add('mark',null,array('label' => false))
            ->add('bodyType',null,array('label' => false))
            ->add('engineSize',null,array('label' => false));
    }
}