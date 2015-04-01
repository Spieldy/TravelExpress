<?php

namespace TE\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class UserController extends Controller
{
    public function registerAction(Request $request)
    {
        $request->getSession()->getFlashBag()->add('notice', 'Vous êtes bien inscrit');
        return $this->forward('TEPlatformBundle:Lift:index');
    }

}
