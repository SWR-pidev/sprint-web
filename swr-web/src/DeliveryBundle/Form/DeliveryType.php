<?php

namespace DeliveryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class DeliveryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('iddman',EntityType::class,array('class'=>'DeliveryBundle:Deliveryman','choice_label'=>'Fname','multiple'=>false))
            ->add('dated')
            ->add('item')
            ->add('idh',EntityType::class,array('class'=>'DeliveryBundle:Housing','choice_label'=>'name','multiple'=>false))
            ->add('save',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DeliveryBundle\Entity\Delivery'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'deliverybundle_delivery';
    }


}
