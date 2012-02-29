<?php

namespace LetsFrame\BiduleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class BiduleType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {


        $builder
            ->add('title')
            ->add('text','textarea',array('required' => false))
            ;
    }

    public function getName()
    {
        return 'letsframe_bidulebundle_biduletype';
    }
}
