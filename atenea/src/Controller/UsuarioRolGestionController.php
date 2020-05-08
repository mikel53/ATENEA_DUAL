<?php

namespace App\Controller;

use App\Entity\Usuarios;
use App\Entity\Permisos;
use App\Entity\UnidadGestion;
use App\Entity\UsuarioRolGestion;

use App\Form\UsuarioRolGestionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\component\Form\FormTypeInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
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

class UsuarioRolGestionController extends AbstractController
{
    /**
     * @Route("/usuarioRolGestion", name="usuarioRolGestion")
     */
    public function index()
    {
        return $this->render('usuarioRolGestion/index.html.twig', [
            'controller_name' => 'UsuarioRolGestionController',
        ]);
    }

    /**
     * @Route("/usuarioRolGestion/list", name="usuarioRolGestion_list")
     */
    public function list()
    {
        $usuarioRolGestion = $this->getDoctrine()
            ->getRepository(UsuarioRolGestion::class)
            ->findAll();

        //codi de prova per visualitzar l'array de alchol
         /*dump($alchol);
         exit();*/

        return $this->render('usuarioRolGestion/list.html.twig', ['usuarioRolGestion' => $usuarioRolGestion]);
    }


    /**
     * @Route("/usuarioRolGestion/new", name="usuarioRolGestion _new")
     */
    public function new(Request $request)
    {
        $usuarioRolGestion = new UsuarioRolGestion();

        //podem personalitzar el text passant una opció 'submit' al builder de la classe jugadorType
        $form = $this->createForm(UsuarioRolGestionType::class, $usuarioRolGestion, array('submit'=>'Crear UsuarioRolGestion'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $usuarioRolGestion = $form->getData();



            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($usuarioRolGestion);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Nuevo UsuariRolGestion: '.$usuarioRolGestion->getUsuarios()->getNombre()
            );

            return $this->redirectToRoute('usuarioRolGestion_list');
        }

        return $this->render('usuarioRolGestion/usuarioRolGestion.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Nuevo UsuarioRolGestion',

        ));
    }

    /**
    * @Route("/suarioRolGestion/edit/{id<\d+>}", name="suarioRolGestion_edit")
    */
   public function edit($id, Request $request)
   {
       $usuarioRolGestion = $this->getDoctrine()
           ->getRepository(UsuarioRolGestion::class)
           ->find($id);

       //podem personalitzar el text del botó passant una opció 'submit' al builder de la classe jugadorType
       $form = $this->createForm(UsuarioRolGestionType::class, $usuarioRolGestion, array('submit'=>'Desar'));

       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {

           $entityManager = $this->getDoctrine()->getManager();
           $entityManager->persist($usuarioRolGestion);
           $entityManager->flush();

           $this->addFlash(
               'notice',
               'Usuario Rol Gestion modificado: '.$usuarioRolGestion->getUsuarios()->getNombre() . " con el rol " . $usuarioRolGestion->getUnidadGestion()->getNombre()
           );

           return $this->redirectToRoute('usuarioRolGestion_list');
       }

       return $this->render('usuarioRolGestion/usuarioRolGestion.html.twig', array(
           'form' => $form->createView(),
           'title' => 'Editar usuario',
       ));
   }

    /**
     * @Route("/usuarioRolGestion/delete/{id<\d+>}", name="usuarioRolGestion_delete")
     */
    public function delete($id, Request $request)
    {
        $usuarioRolGestion = $this->getDoctrine()
            ->getRepository(UsuarioRolGestion::class)
            ->find($id);



        $entityManager = $this->getDoctrine()->getManager();
        $nombreUsuariRol = $usuarioRolGestion->getUsuarios()->getNombre() . " con la unidad de gestion " . $usuarioRolGestion->getUnidadGestion()->getNombre() ;

       $entityManager->remove($usuarioRolGestion);

        $entityManager->flush();

        $this->addFlash(
            'notice',
            'Usuario eliminado: '.$nombreUsuariRol
        );

        return $this->redirectToRoute('usuarioRolGestion_list');
    }
}
