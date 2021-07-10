<?php


namespace App\Form;


use App\Entity\CartItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddToCartType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('amount', IntegerType::class, ['attr' => ['class' => 'form-control', 'placeholder' => 'Amount', 'min'=> 0], 'empty_data' => 1])
            ->add("toCartBtn", SubmitType::class, ['attr' => ['class' => 'btn btn-primary', 'value' => "Add to cart"]]);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
       $resolver->setDefaults([
           'data_class' => CartItem::class
       ]);
    }

}