<?php

namespace LetsFrame\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('LetsFrameAdminBundle:Default:index.html.twig', array('name' => $name));
    }
}
