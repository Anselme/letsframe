<?php

namespace LetsFrame\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{

    public function indexAction()
    {
        return $this->render('LetsFrameGalleryBundle:Default:index.html.twig');
    }
}
