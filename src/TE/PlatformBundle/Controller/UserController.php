<?php

namespace TE\PlatformBundle\Controller;

use TE\PlatformBundle\Entity\Lift;
use TE\PlatformBundle\Entity\Booked;
use TE\PlatformBundle\Entity\User;
use TE\PlatformBundle\Entity\BookedPassenger;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class UserController extends Controller
{
    public function registerAction(Request $request)
    {
        $request->getSession()->getFlashBag()->add('notice', 'Vous êtes bien inscrit');
        return $this->forward('TEPlatformBundle:Lift:index');
    }

    /**
     * @Security("has_role('ROLE_USER')")
     */
    public function profileAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();
        $bookedPassengerRepository = $em->getRepository('TEPlatformBundle:BookedPassenger');
        $driver =  $em->getRepository('TEPlatformBundle:User')->find($id);

        $ownedLift = array();
        $subscribedLift = array();
        $isOwner = false;
        if ($driver == $user) {
            $isOwner = true;
            $ownedLift = $em->getRepository('TEPlatformBundle:Lift')->findByDriver($user);
            $bookedUser = $bookedPassengerRepository->findByPassenger($user);
            foreach ($bookedUser as $bookedPassenger) {
                $subscribedLift[] = $em->getRepository('TEPlatformBundle:Booked')->findBy($bookedPassenger->getBooked()->getLift());
            }
        } else {
            $isOwner = false;
            $ownedLift = $em->getRepository('TEPlatformBundle:Lift')->findByDriver($driver);
        }

        if ($driver->getPositive() == 0 && $driver->getNegative() == 0) {
            $evalDriver = -1;
        } else {
            $evalDriver = ($driver->getPositive()/($driver->getPositive() + $driver->getNegative()))*100;
        }


        return $this->render('TEPlatformBundle:Lift:profile.html.twig',
            array(
                'user' => $driver,
                'ownedLift' => $ownedLift,
                'subscribedLift' => $subscribedLift,
                'isOwner' => $isOwner,
                'evalDriver'=> $evalDriver
                ));
    }

}
