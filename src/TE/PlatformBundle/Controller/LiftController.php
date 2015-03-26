<?php

namespace TE\PlatformBundle\Controller;

use TE\PlatformBundle\Entity\Lift;
use TE\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class LiftController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $liftRepository= $em->getRepository('TEPlatformBundle:Lift');
        $lifts = $liftRepository->findBy(array('isAvailable' => 1), array('dateLift' => 'asc'), null, null);

<<<<<<< HEAD
        return $this->render('TEPlatformBundle:Lift:index.html.twig',array('lifts' => $lifts ));
=======
        return $this->render('TEPlatformBundle:Lift:index.html.twig',array("lifts"=>$lifts));
>>>>>>> 9de26e1afae535dd3a215823282f99b921a974d4
    }

    /**
     * @Security("has_role('IS_AUTHENTICATED_REMEMBERED')")
     */
    public function addAction(Request $request)
    {

    }
  }
