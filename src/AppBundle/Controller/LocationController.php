<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Location;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Form\LocationType;

/**
 * @Route("/locations")
 */
class LocationController extends Controller{

  /**
   * @Route("/", name="indexLocation")
   * @return \Symfony\Component\HttpFoundation\Response
   * @throws \LogicException
   */
   public function indexLocation(Request $request){ // affichage de toutes les annonces
     $repository = $this->getDoctrine()->getRepository(Location::class);
     $locations = $repository->findAll();

     return $this->render('location/index.html.twig',[
       'locations'=>$locations
     ]);
   }

    /**
     * @Route("/rss.xml", name="rssLocation", defaults={"_format"="xml"})
     * @Method("GET")
     * @Cache(smaxage="10")
     */
    public function rssLocation(Request $request){ // affichage du flux RSS
        $repository = $this->getDoctrine()->getRepository(Location::class);
        $locations = $repository->findAll();

        return $this->render('location/index.xml.twig',[
            'locations'=>$locations
        ]);
    }

   /**
    * @Route("/delete/{id}", requirements={"id": "\d+"}, name="deleteLocation")
    */
   public function deleteLocation(Location $location, Request $request){ // suppression d'une annonce
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
   public function newLocation(Request $request){ // ajout d'une annonce
     if($this->getUser() == null){ // possible que si un utilisateur est connecté
           return $this->redirectToRoute('fos_user_security_login');
       }

       $location = new Location();
       $form = $this->createForm(LocationType::class, $location, [
           'action' => $this->generateUrl('newLocation')
       ]);
       $form->handleRequest($request);
       $location->setUser($this->getUser());

       if(!isset($_POST['ajout'])){ // si le form n'a pas envoyé ajout en mode post
            if(!$form->isSubmitted() || !$form->isValid()){
                return $this->render('location/new.html.twig', [
                    'add_location_form' => $form->createView(),
                    'location' => $location,
                ]);
            }
       }
       else{ // sinon on effectue les requetes pour la modification cela veut dire que l'utilisateur à valider
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
    public function updateLocation(Location $location, Request $request){ // modification d'une annonce
      if($this->getUser() == null || $this->getUser() != $location->getUser() || $this->getUser() != $location->getUser() and !( in_array('ROLE_ADMIN', $this->getUser()->getRoles())) ){
          return $this->render('accesdenied.html.twig', [
              'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
          ]);
      }
    if(!isset($_POST['modif'])){ // si le form n'a pas envoyé ajout en mode post
      $form = $this->createForm(LocationType::class, $location);
      $form->handleRequest($request);

      if(!$form->isSubmitted() || !$form->isValid()){
        return $this->render('location/edit.html.twig', [
          'location'=>$location,
          'edit_location_form'=>$form->createView(),
        ]);
      }
    }
    else{  // sinon on effectue les requetes pour la modification cela veut dire que l'utilisateur à valider
      $form = $this->createForm(LocationType::class, $location);
      $form->handleRequest($request);
      $em = $this->getDoctrine()->getManager();
      $em->flush();
      unset($_POST);
      return $this->redirectToRoute('indexLocation');
    }
  }


    /**
     * @Route("/search", name="searchLocation")
     */
    public function searchLocation(Request $request){ // recherche
        $em = $this->getDoctrine()->getManager();
        $ville = $request->get('ville'); // on récupère la velur de l'input name=ville
        $loyer = $request->get('loyer_cc_m'); // " name=loyer_cc_m

        $repository = $em->getRepository('AppBundle:Location');
        if($loyer == null){ // si le user n'a pas rempli le loyer max alors on fait la recherche que sur la ville
            $query = $repository->createQueryBuilder('l')
                ->andWhere('l.ville like :ville')
                ->setParameter('ville', '%'.$ville.'%')
                ->orderBy('l.ville', 'ASC')
                ->getQuery();
        }
        elseif($ville == null){ // et inversement
            $query = $repository->createQueryBuilder('l');
            $query = $query->andWhere($query->expr()->between('l.loyerCcM', '0', ':loyerCcM'))
                ->setParameter('loyerCcM', $loyer)
                ->orderBy('l.loyerCcM', 'ASC')
                ->getQuery();
        }
        else{
            $query = $repository->createQueryBuilder('l');
            $query = $query->andWhere($query->expr()->between('l.loyerCcM', '0', ':loyerCcM'))
                ->setParameter('loyerCcM', $loyer)
                ->orderBy('l.loyerCcM', 'ASC')
                ->andWhere('l.ville like :ville')
                ->setParameter('ville', '%'.$ville.'%')
                ->orderBy('l.ville', 'ASC')
                ->getQuery();
        }

        $listeLocations = $query->getResult();

        return $this->render('location/index.html.twig',[
            'locations'=>$listeLocations
        ]);
    }

    /**
     * @Route("/information/{id}", requirements={"id": "\d+"}, name="infoLocation")
     */
    public function infoLocation(Location $location, Request $request){ // affichage d'une annonce

        return $this->render('location/info.html.twig', [
            'location'=>$location,
        ]);
    }
}
?>
