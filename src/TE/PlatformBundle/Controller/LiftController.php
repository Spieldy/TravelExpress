<?php

namespace TE\PlatformBundle\Controller;

use TE\PlatformBundle\Entity\Lift;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class LiftController extends Controller
{
    public function indexAction()
    {
        return $this->render('TEPlatformBundle:Lift:index.html.twig');
    }

    public function addAction(Request $request)
    {
      $lift = new Lift();
      $user = $this->container->get('security.context')->getToken()->getUser();

      // J'ai raccourci cette partie, car c'est plus rapide à écrire !
      $form = $this->get('form.factory')->createBuilder('form', $lift)
        ->add('fromCity',  'text')
        ->add('toCity',    'text')
        ->add('dateLift',  'date')
        ->add('price',     'money')
        ->add('save',      'submit')
        ->getForm()
      ;

      // On fait le lien Requête <-> Formulaire
      // À partir de maintenant, la variable $lift contient les valeurs entrées dans le formulaire par le visiteur
      $form->handleRequest($request);

      // On vérifie que les valeurs entrées sont correctes
      // (Nous verrons la validation des objets en détail dans le prochain chapitre)
      if ($form->isValid()) {
        // On l'enregistre notre objet $lift dans la base de données, par exemple
        $em = $this->getDoctrine()->getManager();
        $lift->setUser($user);

        $em->persist($lift);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

        // On redirige vers la page de visualisation de l'annonce nouvellement créée
        return $this->redirect($this->generateUrl('te_lift', array('id' => $lift->getId())));
      }

      // À ce stade, le formulaire n'est pas valide car :
      // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
      // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
      return $this->render('TEPlatformBundle:Lift:add.html.twig', array(
        'form' => $form->createView(),
      ));
    }
  }
