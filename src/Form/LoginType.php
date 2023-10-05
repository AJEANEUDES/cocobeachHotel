<?php

namespace App\Form;

use App\DataTransferObject\Credentials;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //Ici on cree notre formulaire de connexion
        $builder->add("email_utilisateur", TextType::class, [
            "label" => false,
            "attr" => [
                "class" => "form-control form-control-lg",
                "id" => "email_utilisateur",
                "placeholder" => "Entrer votre email"
            ]
        ])->add("password", PasswordType::class, [
            "label" => false,
            "attr" => [
                "class" => "form-control form-control-lg",
                "id" => "password",
                "placeholder" => "Entrer votre mot de passe"
            ],
            "invalid_message" => "Information de connextion incorrecte"
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        //Permet de lier notre data_class a un objet Credentials
        $resolver->setDefault("data_class", Credentials::class);
    }
}
