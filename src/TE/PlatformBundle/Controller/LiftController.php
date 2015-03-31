<?php

namespace TE\PlatformBundle\Controller;

use TE\PlatformBundle\Entity\Lift;
use TE\PlatformBundle\Entity\Booked;
use TE\PlatformBundle\Entity\User;
use TE\PlatformBundle\Entity\BookedPassenger;
use TE\PlatformBundle\Form\AddLiftType;
use TE\PlatformBundle\Form\AddPassengerType;
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
        $lifts = $liftRepository->findLiftByDate();
        $liftsSeats = array();
        foreach ($lifts as $lift) {
            $seatsAvailable = 0;
            $booked = $em->getRepository('TEPlatformBundle:Booked')->findOneByLift($lift);
            $listBookedPassenger = $em->getRepository('TEPlatformBundle:BookedPassenger')->findByBooked($booked);
            $nbSeats = 0;
            foreach ($listBookedPassenger as $bookedPassenger) {
                $nbSeats += $bookedPassenger->getSeats();
            }
            $seatsAvailable = $lift->getSeats() - $nbSeats;
            $tab['lift'] = $lift;
            $tab['seats'] = $seatsAvailable;
            $liftsSeats[] = $tab;
        }


        return $this->render('TEPlatformBundle:Lift:index.html.twig', array('lifts' => $liftsSeats));

    }

    public function searchAction(Request $request)
    {
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();
        $liftRepository= $em->getRepository('TEPlatformBundle:Lift');

        if ($request->getMethod() == 'POST') {
            $fromCity = $request->get('fromCity');
            $toCity = $request->get('toCity');
            if ($fromCity == "" || $toCity == "") {
                $request->getSession()->getFlashBag()->add('error', 'Recherche invalide');
                return $this->forward('TEPlatformBundle:Lift:index');
            }
            $lifts = $liftRepository->findLiftByCity(strtolower($fromCity), strtolower($toCity));
            if (count($lifts) == 0 ) {
                $request->getSession()->getFlashBag()->add('error', 'Pas de trajet correspondant à votre recherche');
                return $this->forward('TEPlatformBundle:Lift:index');
            } else {
                $liftsSeats = array();
                foreach ($lifts as $lift) {
                    $seatsAvailable = 0;
                    $booked = $em->getRepository('TEPlatformBundle:Booked')->findOneByLift($lift);
                    $listBookedPassenger = $em->getRepository('TEPlatformBundle:BookedPassenger')->findByBooked($booked);
                    $nbSeats = 0;
                    foreach ($listBookedPassenger as $bookedPassenger) {
                        $nbSeats += $bookedPassenger->getSeats();
                    }
                    $seatsAvailable = $lift->getSeats() - $nbSeats;
                    $tab['lift'] = $lift;
                    $tab['seats'] = $seatsAvailable;
                    $liftsSeats[] = $tab;
                }
            }

            return $this->render('TEPlatformBundle:Lift:search.html.twig', array('lifts' => $liftsSeats));
        } else {
            return $this->forward('TEPlatformBundle:Lift:index');
        }
    }

    /**
     * @Security("has_role('ROLE_USER')")
     */
    public function addAction(Request $request)
    {
      $user = $this->get('security.context')->getToken()->getUser();
      $lift = new Lift();

      $form = $this->createForm(new AddLiftType(), $lift);
      // On fait le lien Requête <-> Formulaire
      // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur

      // On vérifie que les valeurs entrées sont correctes
      // (Nous verrons la validation des objets en détail dans le prochain chapitre)
      if ($form->handleRequest($request)->isValid()) {
        // On l'enregistre notre objet $advert dans la base de données, par exemple
        $em = $this->getDoctrine()->getManager();
        $lift->setFromCity(strtolower($lift->getFromCity()));
        $lift->setToCity(strtolower($lift->getToCity()));
        $lift->setDriver($user);
        $em->persist($lift);

        $booked = new Booked();
        $booked->setDriver($user);
        $booked->setLift($lift);
        $em->persist($booked);

        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Trajet bien enregistrée');

        // On redirige vers la page de visualisation de l'annonce nouvellement créée
        return $this->redirect($this->generateUrl('te_platform_homepage'));
      }

      // À ce stade, le formulaire n'est pas valide car :
      // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
      // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
      return $this->render('TEPlatformBundle:Lift:addLift.html.twig',
      array(
        'form' => $form->createView(),
      ));
    }

    public function viewAction(Request $request, $id)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();

        $liftRepository = $em->getRepository('TEPlatformBundle:Lift');
        $bookedRepository = $em->getRepository('TEPlatformBundle:Booked');
        $bookedPassengerRepository = $em->getRepository('TEPlatformBundle:BookedPassenger');

        $lift = $liftRepository->find($id);
        $booked = $bookedRepository->findOneByLift($lift);

        $isDriver = false;
        $isSubscribed = false;
        $listBookedPassenger = $bookedPassengerRepository->findByBooked($booked);
        $nbSeats = 0;
        foreach ($listBookedPassenger as $bookedPassenger) {
            $nbSeats += $bookedPassenger->getSeats();
        }
        $seatsAvailable = $lift->getSeats() - $nbSeats;

        $passengers = array();
        $evaluation = 0;
        $isPositive = true;

        if ($booked->getDriver() == $user) {
            $isDriver = true;
            $evaluation = $user->getPositive() - $user->getNegative();
            if($evaluation >= 0) {
              $isPositive = true;
            } else {
              $isPositive = false;
            }
            foreach ($listBookedPassenger as $bookedPassenger) {
              $passenger['user'] = $bookedPassenger->getPassenger();
              $passenger['seats'] = $bookedPassenger->getSeats();
              $passengers[] = $passenger;
            }
        } else {
            foreach ($listBookedPassenger as $bookedPassenger) {
              if ($bookedPassenger->getPassenger() == $user) {
                $isSubscribed = true;
                break;
              }
            }
        }

        return $this->render('TEPlatformBundle:Lift:viewLift.html.twig',
          array('lift' => $lift,
                'booked' => $booked,
                'isSubscribed' => $isSubscribed,
                'isDriver' => $isDriver,
                'passengers' => $passengers,
                'evaluation' => $evaluation,
                'isPositive' => $isPositive,
                'seatsAvailable' => $seatsAvailable
          ));
    }

    /**
     * @Security("has_role('ROLE_USER')")
     */
    public function subscribeAction(Request $request, $id)
    {
        $request = $this->get('request');
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $booked = $em->getRepository('TEPlatformBundle:Booked')->find($id);
        $seatsAvailable = 0;
        $nbSeats = 0;

        if( $request->getMethod() == 'POST' ) {
            $seats = $request->get('seats');
            $listBookedPassenger = $em->getRepository('TEPlatformBundle:BookedPassenger')->findByBooked($booked);
            $nbSeats = 0;
            foreach ($listBookedPassenger as $bookedPassenger) {
                $nbSeats += $bookedPassenger->getSeats();
            }
            $seatsAvailable = $booked->getLift()->getSeats() - $nbSeats;

            if ($seats > $seatsAvailable) {
                $request->getSession()->getFlashBag()->add('error', 'Trop de passagers');
            } else {
                $bookedPassenger = new BookedPassenger();
                $bookedPassenger->setPassenger($user);
                $bookedPassenger->setBooked($booked);
                $bookedPassenger->setSeats($seats);
                if ($seats == $seatsAvailable) {
                    $lift = $booked->getLift();
                    $lift->setIsAvailable(0);
                    $em->persist($lift);
                }
                $em->persist($bookedPassenger);
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Inscription au trajet bien enregistrée');
            }
        }

        $idLift = $booked->getLift()->getId();
        $response = $this->forward('TEPlatformBundle:Lift:view', array('id' => $idLift));
        return $response;
    }

    /**
     * @Security("has_role('ROLE_USER')")
     */
    public function unsubscribeAction(Request $request, $id)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $booked = $em->getRepository('TEPlatformBundle:Booked')->find($id);

        $bookedPassengerRepository = $em->getRepository('TEPlatformBundle:BookedPassenger');
        $bookedPassenger = $bookedPassengerRepository->findOneBy(array("booked" => $booked, "passenger" => $user));
        if ($booked->getLift()->getIsAvailable() == 0) {
            $booked->getLift()->setIsAvailable(1);
            $em->persist($booked->getLift());
        }

        $em->remove($bookedPassenger);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Désinscription au trajet réussie');

        $idLift = $booked->getLift()->getId();
        $response = $this->forward('TEPlatformBundle:Lift:view', array('id' => $idLift));
        return $response;
    }

    /**
     * @Security("has_role('ROLE_USER')")
     */
    public function positiveAction($id)
    {
        $response = $this->forward('TEPlatformBundle:Lift:view', array('id' => $id));
        return $response;
    }

    /**
     * @Security("has_role('ROLE_USER')")
     */
    public function negativeAction($id)
    {
        $response = $this->forward('TEPlatformBundle:Lift:view', array('id' => $id));
        return $response;
    }

  }
