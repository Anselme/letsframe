<?php

namespace LetsFrame\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class MainController extends Controller
{

    public function indexAction()
    {
        return $this->render('LetsFrameMainBundle:Main:index.html.twig');
    }
}
