<?php

namespace App\Controller;

use App\Entity\Usuarios;
use App\Entity\UsuarioRolGestion;

use App\Form\UsuariosType;
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

class UsuariosController extends AbstractController
{
    /**
     * @Route("/usuarios", name="usuarios")
     */
    public function index()
    {
        return $this->render('usuarios/index.html.twig', [
            'controller_name' => 'UsuariosController',
        ]);
    }

    /**
     * @Route("/usuarios/list", name="usuarios_list")
     */
    public function list()
    {
        $usuarios = $this->getDoctrine()
            ->getRepository(Usuarios::class)
            ->findAll();

        //codi de prova per visualitzar l'array de alchol
         /*dump($alchol);
         exit();*/

        return $this->render('usuarios/list.html.twig', ['usuarios' => $usuarios]);
    }




    /**
     * @Route("/usuarios/new", name="usuarios_new")
     */
    public function new(Request $request)
    {
        $usuarios = new Usuarios();

        //podem personalitzar el text passant una opció 'submit' al builder de la classe jugadorType
        $form = $this->createForm(UsuariosType::class, $usuarios, array('submit'=>'Crear Usuarios'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {



            $usuarios = $form->getData();

            $usuarios->setPassword(crypt($usuarios->getPassword(), null));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($usuarios);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Nuevo Usuario: '.$usuarios->getNombre()
            );




            return $this->redirectToRoute('usuarioRolGestion _new');
        }

        return $this->render('usuarios/usuarios.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Nuevo Usuario',

        ));
    }

    /**
    * @Route("/usuarios/edit/{id<\d+>}", name="usuarios_edit")
    */
   public function edit($id, Request $request)
   {
       $usuarios = $this->getDoctrine()
           ->getRepository(Usuarios::class)
           ->find($id);

           $password0 = $usuarios->getPassword();

       //podem personalitzar el text del botó passant una opció 'submit' al builder de la classe jugadorType
       $form = $this->createForm(UsuariosType::class, $usuarios, array('submit'=>'Desar'));

       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {
         $usuarios = $form->getData();

           $entityManager = $this->getDoctrine()->getManager();

        //  if ($usuarios->getPassword() == null){
        if(empty($usuarios->getPassword)){
          $usuarios->setPassword($password0);

          } else {
            $usuarios->setPassword(crypt($usuarios->getPassword(), null));

          }
           $entityManager->persist($usuarios);
           $entityManager->flush();

           $this->addFlash(
               'notice',
               'Usuario modificado: '.$usuarios->getNombre()
           );

           return $this->redirectToRoute('usuarios_list');
       }

       return $this->render('usuarios/usuarios.html.twig', array(
           'form' => $form->createView(),
           'title' => 'Editar usuario',
       ));
   }

    /**
     * @Route("/usuarios/delete/{id<\d+>}", name="usuarios_delete")
     */
    public function delete($id, Request $request)
    {
        $usuarios = $this->getDoctrine()
            ->getRepository(Usuarios::class)
            ->find($id);



        $entityManager = $this->getDoctrine()->getManager();
        $nombreUsuario = $usuarios->getNombre();

       $entityManager->remove($usuarios);

        $entityManager->flush();

        $this->addFlash(
            'notice',
            'Usuario eliminado: '.$nombreUsuario
        );

        return $this->redirectToRoute('usuarios_list');
    }

    /**
     * @Route("/usuarios/search", name="usuarios_search")
     */
    public function search(Request $request)
    {
        //recollim el paràmetre 'term' enviat per post
        $term = $request->request->get('term');
        $usuarios = $this->getDoctrine()
            ->getRepository(Usuarios::class)
            ->findby(array('nombre'=> $term));

        return $this->render('usuarios/list.html.twig', [
            'usuarios' => $usuarios,
            'searchTerm' => $term
        ]);
    }
}
