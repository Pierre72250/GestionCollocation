<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Location;
use AppBundle\Entity\User;
use AppBundle\Form\LocationType;

/**
 * @Route("/location")
 */
class LocationController extends Controller{

  /**
   * @Route("/", name="indexLocation")
   * @return \Symfony\Component\HttpFoundation\Response
   * @throws \LogicException
   */
   public function indexLocation(Request $request){
     $repository = $this->getDoctrine()->getRepository(Location::class);
     $locations = $repository->findAll();
     return $this->render('location/index.html.twig',[
       'locations'=>$locations
     ]);
   }

   /**
    * @Route("/delete/{id}", requirements={"id": "\d+"}, name="deleteLocation")
    */
   public function deleteLocation(Location $location, Request $request){
     $em = $this->getDoctrine()->getManager();
     $em->remove($location);
     $em->flush();

     return $this->redirectToRoute('indexLocation');
   }

   /**
    * @Route("/add", name="newLocation")
    * @return \Symfony\Component\HttpFoundation\Response
    * @throws \LogicException
    */
   public function newLocation(Request $request){

       if($this->getUser() == null){
           return $this->redirectToRoute('fos_user_security_login');
       }

       $location = new Location();
       $form = $this->createForm(LocationType::class, $location, [
           'action' => $this->generateUrl('newLocation')
       ]);
       $form->handleRequest($request);
       $location->setUser($this->getUser());

       if(!isset($_POST['ajout'])){
            if(!$form->isSubmitted() || !$form->isValid()){
                return $this->render('location/new.html.twig', [
                    'add_location_form' => $form->createView(),
                    'location' => $location,
                ]);
            }
       }
       else{
           $em = $this->getDoctrine()->getManager();
           $em->persist($location);
           $em->flush();
           unset($_POST);
           return $this->redirectToRoute('indexLocation');
       }
   }

   /**
    * @Route("/edit/{id}", requirements={"id": "\d+"}, name="updateLocation")
    */
    public function updateLocation(Location $location, Request $request){
      if(!isset($_POST['modif'])){
        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);

        if(!$form->isSubmitted() || !$form->isValid()){
          return $this->render('location/edit.html.twig', [
            'location'=>$location,
            'edit_location_form'=>$form->createView(),
          ]);
        }
      }
      else{

      }
      $form = $this->createForm(LocationType::class, $location);
      $form->handleRequest($request);
      $em = $this->getDoctrine()->getManager();
      $em->flush();
      unset($_POST);
      return $this->redirectToRoute('indexLocation');
    }
}
?>
