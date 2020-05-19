<?php
namespace App\Controller;

use App\Form\CuestionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Entity\Cuestiones;
use App\Entity\Subtipos;
use App\Entity\Tipos;

class CuestionesController extends AbstractController{
    /**
     * @Route("/", name="home")
     */
    public function index(){
        return $this->render('cuestiones/index.html.twig',[
            'controller_name' => 'CuestionesController',
        ]);
    }

    /**
     * @Route("/cuestiones/list/bysub/{id}", name="list_cuestiones")
     */

    public function listOne(Request $request){
        $subId = $request->request->get('id');
        $cuestiones = $this->getDoctrine()->getRepository(Cuestiones::Class)
        ->findBySubTipo($subId);
        if ($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {  
            $jsonData = array();  
            $idx = 0;
            
            foreach($cuestiones as $c) {  
                $temp = array(
                   'id' => $c->getId(),  
                   'descripcion'=>$c->getDescripcion()  
                );   
                $jsonData[$idx++] = $temp;  
             } 
            return new JsonResponse($jsonData); 
         } else { 
            return $this->render('cuestiones/internas/list.html.twig'); 
         } 

    }
    /**
     * @Route("/cuestiones/internas/dafo/aspectos/{id}", name="list_aspectos_internos")
     */
    public function getAspectosInternos(Request $request){
        $cId = $request->request->get('id');
        $cuestion = $this->getDoctrine()->getRepository(Cuestiones::class)
        ->find($cId);
        $aspectos = $cuestion->getAspectos();
        if($request->isXmlHttpRequest() || $request->query->get('showJson') == 1){
            $jsonData = array();  
            $idx = 0;
            foreach($aspectos as $a){
                $temp = array(
                    'id'=>$a->getId(),
                    'descripcion'=>$a->getDescripcion(),
                    'favorable'=>$a->getFavorable(),
                );
                $jsonData[$idx++] = $temp;
            }
            return new JsonResponse($jsonData);
        }else{
            return $this->render('cuestiones/internas/dafo.html.twig');
        }
    }
    /**
     * @Route("/cuestiones/internas/nuevo", name="cuestiones_internas_nuevo")
     */

     public function addCuestionInterna(Request $request){
        $cuestionInterna = new Cuestiones();
        $form = $this->createForm(CuestionType::class, $cuestionInterna, array('submit'=>'Crear cuestion'));
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
           $cuestionInterna = $form->getData();
           $entityManager = $this->getDoctrine()->getManager();
           $entityManager->persist($cuestionInterna);
           $entityManager->flush();
           return $this->redirectToRoute('cuestiones_internas_list');
        }

        return $this->render('cuestiones/internas/cuestion.html.twig',array(
            'form'=>$form->createView(),
            'title' => 'Nueva Cuestion',
        ));

     }

     /**
      * @Route("cuestiones/externas/nuevo", name="cuestiones_externas_nuevo")
      */

      public function addCuestionExterna(Request $request){
        $cuestionInterna = new Cuestiones();
        $form = $this->createForm(CuestionType::class, $cuestionInterna, array('submit'=>'Crear cuestion'));
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
           $cuestionInterna = $form->getData();
           $entityManager = $this->getDoctrine()->getManager();
           $entityManager->persist($cuestionInterna);
           $entityManager->flush();
           return $this->redirectToRoute('cuestiones_externas_list');
        }

        return $this->render('cuestiones/externas/cuestion.html.twig',array(
            'form'=>$form->createView(),
            'title' => 'Nueva Cuestion',
        ));

     }

     /**
      * @Route("/cuestiones/internas/edita/{id<\d+>}", name="cuestiones_internas_edita")
      */
     public function editCuestionInterna($id, Request $request){
        $cuestion = $this->getDoctrine()->getRepository(Cuestiones::class)
        ->find($id);

        $form = $this->createForm(CuestionType::class, $cuestion, array(
            'submit'=>'Guardar'
        ));
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $cuestion = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cuestion);
            $entityManager->flush();
            return $this->redirectToRoute('cuestiones_internas_list');
        }
        return $this->render('cuestiones/internas/cuestion.html.twig', array(
            'form'=>$form->createView(),
            'title'=>'Editar Cuestion'
        ));
     }

        /**
      * @Route("/cuestiones/externas/edita/{id<\d+>}", name="cuestiones_internas_edita")
      */
      public function editCuestionExterna($id, Request $request){
        $cuestion = $this->getDoctrine()->getRepository(Cuestiones::class)
        ->find($id);

        $form = $this->createForm(CuestionType::class, $cuestion, array(
            'submit'=>'Guardar'
        ));
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $cuestion = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cuestion);
            $entityManager->flush();
            return $this->redirectToRoute('cuestiones_externas_list');
        }
        return $this->render('cuestiones/externas/cuestion.html.twig', array(
            'form'=>$form->createView(),
            'title'=>'Editar Cuestion'
        ));

     }

        /**
         * @Route("/cuestiones/externas/dafo/list", name="cuestiones_externas_dafo_list")
         */
        public function listCuestionesExternas(){
            $usuario = $this->get('security.token_storage')->getToken()->getUser();
            $cuestiones = $this->getDoctrine()->getRepository(Cuestiones::Class)
            ->findByExternas();
            return $this->render('cuestiones/externas/dafo.html.twig', ['cuestiones'=>$cuestiones]);
        }
        
        /**
         * @Route("/cuestiones/internas/dafo/list", name="cuestiones_internas_dafo_list")
         */
        public function listCuestionesInternas(){
            $usuario = $this->get('security.token_storage')->getToken()->getUser();
            $cuestiones = $this->getDoctrine()->getRepository(Cuestiones::Class)
            ->findByInternas();
            return $this->render('cuestiones/internas/dafo.html.twig', ['cuestiones'=>$cuestiones]);
        } 
}



?>