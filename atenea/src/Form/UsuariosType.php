<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Validator\Constraints\File;
use App\Entity\Usuarios;


class UsuariosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $roles = ['Admin', 'Super', 'User'];
        $builder
            ->add('Nombre', TextType::class)
            ->add('Apellidos', TextType::class)
            ->add('Telefono', IntegerType::class)
            ->add('Mail', TextType::class)
            ->add('FechaAlta', DateType::class)
            ->add('FechaBaja', DateType::class)

            ->add('Password', RepeatedType::class, [
                  'type' => TextType::class,
                  'first_options'  => ['label' => 'Password'],
                  'second_options' => ['label' => 'Repeat Password'],
            ])

          //    $builder->add('Password', TextType::class)


           ->add('Roles', ChoiceType::class, [
              'choices' => $roles,
              'multiple' => true,
              'expanded' => true
          ])




            //->add('save', SubmitType::class, array('label' => 'Crear Usuarios'))
            ->add('save', SubmitType::class, array('label' => $options['submit']))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
            'submit' => 'Enviar',
        ]);
    }




}
