<?php

namespace App\Form;


use App\Entity\Pais;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;





class PaisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('presidente', PresidenteType::class)
            ->add('nombre', null, array(
             'required' => true,
             'empty_data' => 'Nombre',
             'attr' => array(
                'class'=> 'campos'
             )
        ))

            ->add('continente')
            
            ->add('save', SubmitType::class, array(
                'attr' => array('class' => 'btn btn-success'),
        ));
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pais::class,
        ]);
    }
}