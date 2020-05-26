<?php

namespace App\Controller;

use App\Form\SubtipoType;
use App\Entity\Subtipos;
use App\Entity\UnidadGestion;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


class SubTiposController extends AbstractController
{
    /**
     * @Route("/sub/tipos", name="sub_tipos")
     */
    public function index()
    {
        return $this->render('sub_tipos/index.html.twig', [
            'controller_name' => 'SubTiposController',
        ]);
    }

    /**
     * @Route("/cuestiones/list/{id}", name="list_subtipos")
     */

    public function listOne(Request $request){
        $id = $request->request->get('id');
        $subtipos = $this->getDoctrine()->getRepository(Subtipos::Class)
        ->findByTipo($id);
        if ($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {  
            $jsonData = array();  
            $idx = 0;
            
            foreach($subtipos as $s) {  
                $temp = array(
                   'id' => $s->getId(),  
                   'descripcion'=>$s->getDescripcion()  
                );   
                $jsonData[$idx++] = $temp;  
             }
            return new JsonResponse($jsonData); 
         } else { 
            return $this->render('cuestiones/internas/list.html.twig'); 
         } 
    }

    /**
     * @Route("/subtipos/nuevo", name="subtipos_nuevo")
     */
    public function addSubTipo(Request $request){
        $id = $_GET["id"];

        $udGestion = $this->getDoctrine()->getRepository(UnidadGestion::class)->find($id);

        $subtipo = new Subtipos();
        $form = $this->createForm(SubTipoType::class, $subtipo, array('submit'=>'Crear Subtipo'));
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
           $subtipo = $form->getData();
           $entityManager = $this->getDoctrine()->getManager();
           $entityManager->persist($subtipo);
           $entityManager->flush();
           return $this->redirectToRoute('cuestiones_internas_list',['id' => $udGestion->getId()]);
        }

        return $this->render('cuestiones/internas/cuestion.html.twig',array(
            'form'=>$form->createView(),
            'title' => 'Nuevo Subtipo',
        ));
    }

      /**
      * @Route("/subtipos/edita/{id}/{ugId}" , name="subtipos_edita")
      */

      public function editSubTipo(Request $request, $id, $ugId){
        $udGestion = $this->getDoctrine()->getRepository(UnidadGestion::class)->find($ugId);

        $subtipo = $this->getDoctrine()->getRepository(SubTipos::class)
        ->find($id);

        $form = $this->createForm(SubTipoType::class, $subtipo, array(
            'submit'=>'Guardar'
        ));
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $tipo = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($subtipo);
            $entityManager->flush();
            return $this->redirectToRoute('cuestiones_internas_list',['id' => $udGestion->getId()]);
        }
        return $this->render('subtipos/subtipo.html.twig', array(
            'form'=>$form->createView(),
            'title'=>'Editar Subtipo',
        ));
      }
}
