<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserRegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',null,array('label' => false))
            ->add('email' ,null,array('label' => false))
            ->add('password',RepeatedType::class,[
                'mapped' => false,
                'type' => PasswordType::class,
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Choose a password !'
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Please enter password that contains at least 8 chars !'
                    ])
                ],
                'first_options' => array('label' => false),
                'second_options' => array('label' => false)
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
