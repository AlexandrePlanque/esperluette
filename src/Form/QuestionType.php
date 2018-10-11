<?php
namespace App\Form;

use App\Entity\Transaction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use App\Form\DataTransformer\ImageToSiteTransformer;

class QuestionType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('prix', NumberType::class, array(
            'attr' => array('class' => 'textCentre'),
        ))
        ->add('fdp', NumberType::class, array(
            'attr' => array('class' => 'textCentre'),
            'required' => false,
        ))
        ->add('reduction', NumberType::class, array(
            'attr' => array('class' => 'textCentre'),
            'label' => 'Reduc',
            'required' => false,
        ))
        ->add('superPts', IntegerType::class, array(
            'attr' => array('class' => 'textCentre'),
            'label' => 'SuperPts',
            'required' => false,
        ))
        ->add('prixFinal', NumberType::class, array(
            'attr' => array('class' => 'textCentre'),
            'label' => 'Final',
        ))
        ->add('user', TextType::class, array(
            'attr' => array('class' => 'textCentre'),
            'required' => false,
        ))
        ->add('dateTransaction', DateType::class, [
            'widget' => 'single_text',
            'attr' => array('class' => 'textCentre'),
            'format' => 'dd/MM/yyyy',
            'html5' => false,
        ])
        ->add('site', IntegerType::class, array(
            'invalid_message' => 'That is not a valid site number',
            'attr' => array('class' => 'sr-only'),
        ))
        ->add('commentaire', TextType::class, array(
            'required' => false,
        ));

        $builder->get('site')
            ->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Transaction::class,
        ));
    }
}
