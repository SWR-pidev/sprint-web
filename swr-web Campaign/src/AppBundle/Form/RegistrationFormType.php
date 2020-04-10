<?php


namespace AppBundle\Form;


use Symfony\Component\Finder\Iterator\FilePathsIterator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseRegistrationtype;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder->add('nom')
               ->add('prenom')
               ->add('country')
               ->add('tel');


    }

    public function getParent()
    {
       return BaseRegistrationtype::class;
    }

    public function getName()
    {

        return 'appBundle_user';
    }
}