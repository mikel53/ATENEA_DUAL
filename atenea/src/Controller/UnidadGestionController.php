<?php

namespace App\Controller;


use App\Entity\UnidadGestion;
use App\Form\UnidadGestionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\component\Form\FormTypeInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\Common\Persistence\ManagerRegistry;
use Fig\Link\GenericLinkProvider;
use Fig\Link\Link;
use Psr\Container\ContainerInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\WebLink\EventListener\AddLinkHeaderListener;

class UnidadGestionController extends AbstractController
{
    /**
     * @Route("/unidadGestion", name="unidadGestion")
     */
    public function index()
    {
        return $this->render('unidadGestion/index.html.twig', [
            'controller_name' => 'UnidadGestionController',
        ]);
    }

    /**
     * @Route("/unidadGestion/list", name="unidadGestion_list")
     */
    public function list()
    {
        $unidadGestion = $this->getDoctrine()
            ->getRepository(UnidadGestion::class)
            ->findAll();


        return $this->render('unidadGestion/list.html.twig', ['unidadGestion' => $unidadGestion]);
    }

    /**
     * @Route("/unidadGestion/new", name="unidadGestion_new")
     */
    public function new(Request $request)
    {
        $unidadGestion = new UnidadGestion();

        //podem personalitzar el text passant una opció 'submit' al builder de la classe jugadorType
        $form = $this->createForm(UnidadGestionType::class, $unidadGestion, array('submit'=>'Crear Unidad de Gestion'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $unidadGestion = $form->getData();



            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($unidadGestion);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Nueva Unidad: '.$unidadGestion->getNombre()
            );

            return $this->redirectToRoute('unidadGestion_list');
        }

        if(isset($_POST['unidadGestion'])) {
            $identitat = $_POST['unidadGestion'];
          } else {
          // si no ens han enviat res agafem la primera provincia de la taula
            $identitat = 1;
          }

          $entitat = $this->getDoctrine()
              ->getRepository(UnidadGestion::class)->find($identitat);
var_dump($entitat);
         $poblacions = $this->getDoctrine()
                ->getRepository(UnidadGestion::class)->findBy(['coo_em_empl' => $entitat]);

var_dump($poblacions);




        return $this->render('unidadGestion/unidadGestion.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Nueva Unidad',

        ));
    }

    /**
    * @Route("/unidadGestion/edit/{id<\d+>}", name="unidadGestion_edit")
    */
   public function edit($id, Request $request)
   {
       $unidadGestion = $this->getDoctrine()
           ->getRepository(UnidadGestion::class)
           ->find($id);

       //podem personalitzar el text del botó passant una opció 'submit' al builder de la classe jugadorType
       $form = $this->createForm(UnidadGestionType::class, $unidadGestion, array('submit'=>'Desar'));

       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {

           $entityManager = $this->getDoctrine()->getManager();
           $entityManager->persist($unidadGestion);
           $entityManager->flush();

           $this->addFlash(
               'notice',
               'Unidad de Gestion modificado: '.$unidadGestion->getNombre()
           );

           return $this->redirectToRoute('unidadGestion_list');
       }

       return $this->render('unidadGestion/unidadGestion.html.twig', array(
           'form' => $form->createView(),
           'title' => 'Editar Unidad de Gestion',
       ));
   }

    /**
     * @Route("/unidadGestion/delete/{id<\d+>}", name="unidadGestion_delete")
     */
    public function delete($id, Request $request)
    {
        $unidadGestion = $this->getDoctrine()
            ->getRepository(UnidadGestion::class)
            ->find($id);



        $entityManager = $this->getDoctrine()->getManager();
        $nombreUnidad = $unidadGestion->getNombre();

       $entityManager->remove($unidadGestion);

        $entityManager->flush();

        $this->addFlash(
            'notice',
            'Unidad de Gestion eliminado: '.$nombreUnidad
        );

        return $this->redirectToRoute('unidadGestion_list');
    }
      /**
  * @Route("/unidadGestion/search", name="unidadGestion_filtrar")
  */
  public function filtrar(Request $request)
  {
  //recollim el paràmetre 'equipoLiga' enviat per post
  $term = $request->request->get('unidadGestionTipo');

  if($term == 'todos'){
   $unidadGestion = $this->getDoctrine()
       ->getRepository(UnidadGestion::class)
       ->findAll();

  } else{
     $unidadGestion = $this->getDoctrine()
      ->getRepository(UnidadGestion::class)
      ->findBy(array('coo_em_empl' => $term));
      //findLikeNom($term);
  }



  return $this->render('unidadGestion/list.html.twig', ['unidadGestion' => $unidadGestion, 'searchTerm' => $term]);

  }
}
