<?php

namespace TE\PlatformBundle\Controller;

use TE\PlatformBundle\Entity\User;
use TE\PlatformBundle\Form\RegisterType;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function loginAction(Request $request)
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('TEPlatformBundle:User:login.html.twig', array(
            // last username entered by the user
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));

    }

    public function logoutAction()
    {
        return $this->render('TEPlatformBundle:User:logout.html.twig', array(
                // ...
            ));    }

    public function registerAction(Request $request)
    {
      $user = new User();
      $user->setRoles('ROLE_USER');
      $user->setSalt('');
      $form = $this->get('form.factory')->create(new RegisterType(), $user);

      if ($form->handleRequest($request)->isValid()) {
        //encrypt user password
        $factory = $this->get('security.encoder_factory');
        $encoder = $factory->getEncoder($user);

        //generate password
        $password = $encoder->encodePassword($form["password"]->getData(), $user->getSalt());

        if (!$encoder->isPasswordValid($password, $form["password"]->getData(), $user->getSalt())) {
            throw new \Exception('Password incorrectly encoded during user registration');
        } else {
            $user->setPassword($password);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Utilisateur bien enregistrée.');

        return $this->redirect($this->generateUrl('te_platform_homepage'));
      }

      return $this->render('TEPlatformBundle:User:register.html.twig', array(
        'form' => $form->createView(),
      ));
    }

}
