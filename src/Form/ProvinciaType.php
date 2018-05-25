<?php

namespace App\Form;

use App\Entity\Region;
use App\Entity\Localidad;
use App\Entity\Provincia;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;





class ProvinciaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', null, array(
             'required' => true,
             'empty_data' => 'Nombre',
             'attr' => array(
                'class'=> 'campos'
             )
        ))

           
            ->add('save', SubmitType::class, array(
                'attr' => array('class' => 'btn btn-success'),
        ));
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Provincia::class,
        ]);
    }
}