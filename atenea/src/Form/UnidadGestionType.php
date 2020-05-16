<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use App\Entity\UnidadGestion;
use App\Entity\Contratos;



class UnidadGestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('FechaAlta', DateType::class)
            ->add('FechaBaja', DateType::class)
            ->add('Nombre', TextType::class)
          //  ->add('CooEmEmpl', TextType::class)

            ->add('CooEmEmpl', ChoiceType::class, [
                'choices'  => [
                    'Coorporacio' => 'Coo',
                    'Empresa' => 'Em',
                    'Emplaçament' => 'Empl',
                ],
            ])
            ->add('Contratos', EntityType::class, array('class' => Contratos::class,
            'choice_label' => 'descripcion'))

            ->add('UnidadGestion', EntityType::class, array('class' => UnidadGestion::class,
            'choice_label' => 'nombre'))





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
