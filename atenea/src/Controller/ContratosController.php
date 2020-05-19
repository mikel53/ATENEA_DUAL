<?php

namespace App\Controller;

use App\Entity\Contratos;
use App\Form\ContratosType;
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

class ContratosController extends AbstractController
{
    /**
     * @Route("/contratos", name="contratos")
     */
    public function index()
    {
        return $this->render('contratos/index.html.twig', [
            'controller_name' => 'ContratosController',
        ]);
    }

    /**
     * @Route("/contratos/list", name="contratos_list")
     */
    public function list()
    {
        $contratos = $this->getDoctrine()
            ->getRepository(Contratos::class)
            ->findAll();

        //codi de prova per visualitzar l'array de alchol
         /*dump($alchol);
         exit();*/

        return $this->render('contratos/list.html.twig', ['contratos' => $contratos]);
    }

    /**
     * @Route("/contratos/new", name="contratos_new")
     */
    public function new(Request $request)
    {
        $contratos = new Contratos();

        //podem personalitzar el text passant una opció 'submit' al builder de la classe jugadorType
        $form = $this->createForm(ContratosType::class, $contratos, array('submit'=>'Crear Contrato'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $contratos = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contratos);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Nuevo Usuario: '.$contratos->getDescripcion()
            );

            return $this->redirectToRoute('contratos_list');
        }

        return $this->render('contratos/contratos.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Nuevo Contrato',

        ));
    }

    /**
    * @Route("/contratos/edit/{id<\d+>}", name="contratos_edit")
    */
   public function edit($id, Request $request)
   {
       $contratos = $this->getDoctrine()
           ->getRepository(Contratos::class)
           ->find($id);

       //podem personalitzar el text del botó passant una opció 'submit' al builder de la classe jugadorType
       $form = $this->createForm(ContratosType::class, $contratos, array('submit'=>'Desar'));

       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {

           $entityManager = $this->getDoctrine()->getManager();
           $entityManager->persist($contratos);
           $entityManager->flush();

           $this->addFlash(
               'notice',
               'Contrato modificado: '.$contratos->getDescripcion()
           );

           return $this->redirectToRoute('usuarios_list');
       }

       return $this->render('contratos/contratos.html.twig', array(
           'form' => $form->createView(),
           'title' => 'Editar contrato',
       ));
   }

    /**
     * @Route("/contratos/delete/{id<\d+>}", name="contratos_delete")
     */
    public function delete($id, Request $request)
    {
        $contratos = $this->getDoctrine()
            ->getRepository(Contratos::class)
            ->find($id);



        $entityManager = $this->getDoctrine()->getManager();
        $desCon = $contratos->getDescripcion();

       $entityManager->remove($contratos);

        $entityManager->flush();

        $this->addFlash(
            'notice',
            'Contrato eliminado: '.$desCon
        );

        return $this->redirectToRoute('contratos_list');
    }
}
