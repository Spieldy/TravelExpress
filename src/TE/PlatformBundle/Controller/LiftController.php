<?php

namespace TE\PlatformBundle\Controller;

use TE\PlatformBundle\Entity\Lift;
use TE\UserBundle\Entity\User;
use TE\PlatformBundle\Form\AddLiftType;
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

        return $this->render('TEPlatformBundle:Lift:index.html.twig',array('lifts' => $lifts ));

    }

    /**
     * @Security("has_role('ROLE_USER')")
     */
    public function addAction(Request $request)
    {
      $lift = new Lift();

      $form = $this->createForm(new AddLiftType(), $lift);
      // On fait le lien Requête <-> Formulaire
      // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur

      // On vérifie que les valeurs entrées sont correctes
      // (Nous verrons la validation des objets en détail dans le prochain chapitre)
      if ($form->handleRequest($request)->isValid()) {
        // On l'enregistre notre objet $advert dans la base de données, par exemple
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();
        $lift->setUser($user);
        $em->persist($lift);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Trajet bien enregistrée.');

        // On redirige vers la page de visualisation de l'annonce nouvellement créée
        return $this->redirect($this->generateUrl('te_platform_homepage'));
      }

      // À ce stade, le formulaire n'est pas valide car :
      // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
      // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
      return $this->render('TEPlatformBundle:Lift:addLift.html.twig', array(
        'form' => $form->createView(),
      ));
    }

    public function viewAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $liftRepository= $em->getRepository('TEPlatformBundle:Lift');
        $lift = $liftRepository->find($id);
        return $this->render('TEPlatformBundle:Lift:viewLift.html.twig', array('lift' => $lift));
    }

    public function subscribeAction(Request $request)
    {
        return $this->render('index.html.twig');
    }

    public function unsubscribeAction(Request $request)
    {
        return $this->render('index.html.twig');
    }
  }
