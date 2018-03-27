<?php
/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 27/03/2018
 * Time: 04:04
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;

/**
 * @Route("/users")
 */
class UserController extends Controller
{
    /**
     * @Route("/", name="indexUsers")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \LogicException
     */
    public function indexLocation(Request $request){
        $repository = $this->getDoctrine()->getRepository(User::class);
        $users = $repository->findAll();

        return $this->render('user/index.html.twig',[
            'users'=>$users
        ]);
    }

    /**
     * @Route("/desable/{id}", requirements={"id": "\d+"}, name="desableUser")
     */
    public function desableUser(User $user, Request $request){
        $user->setEnabled(false);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        return $this->redirectToRoute('indexUsers');
    }

    /**
     * @Route("/enable/{id}", requirements={"id": "\d+"}, name="enableUser")
     */
    public function enableUser(User $user, Request $request){
        $user->setEnabled(true);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        return $this->redirectToRoute('indexUsers');
    }
}