<?php

namespace LetsFrame\GalleryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('image')
        ;
    }

    public function getName()
    {
        return 'letsframe_gallerybundle_imagetype';
    }
}
