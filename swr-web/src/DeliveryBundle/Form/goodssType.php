<?php

namespace DeliveryBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class goodssType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('item', EntityType::class, array('class' => 'DeliveryBundle:Items', 'choice_label' => 'name', 'multiple' => false))
            ->add('idh', EntityType::class, array('class' => 'DeliveryBundle:Housing', 'choice_label' => 'name', 'multiple' => false))
            ->add('qcollected')
            ->add('status',ChoiceType::class,[
                'choices' => [
                    'choose medicine'=>'choose medicine',
                    'Panadol' => 'Panadol',
                    'Doliprane' => 'Doliprane',
                    'efferalgan'=>'efferalgan',
                ]])
            ->add('Contribute', SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DeliveryBundle\Entity\goodss'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'deliverybundle_goodss';
    }


}
