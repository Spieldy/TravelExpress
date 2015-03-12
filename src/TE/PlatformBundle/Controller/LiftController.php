<?php

namespace TE\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LiftController extends Controller
{
    public function indexAction()
    {
        return $this->render('TEPlatformBundle:Lift:index.html.twig');
    }
}
