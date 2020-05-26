<?php
namespace App\Controller;

use App\Form\AspectoInternoType;
use App\Form\AspectoExternoType;
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
use App\Entity\Aspectos;
use App\Entity\FactoresRiesgo;

class AspectosController extends AbstractController{



    /**
     * @Route("/factores/list", name="list_all_aspectos")
     */

     public function getAllAspectos(Request $request){
        $factores = $this->getDoctrine()->getRepository(FactoresRiesgo::class)
        ->findAll();
        $aspectos = $this->getDoctrine()->getRepository(Aspectos::class)
        ->findAll(); 
        return $this->render('factores/list.html.twig', ['aspectos'=>$aspectos, 'factores'=>$factores]);

    }
    /**
     * @Route("/cuestiones/internas/dafo/edita/{id}"), name="aspectos_internos_edit"
     */
    public function editAspectosInternos(Request $request, $id){
        $aspecto = $this->getDoctrine()->getRepository(Aspectos::class)
        ->find($id);
        $cuestiones = array();
        $cuestion = $aspecto->getAspectoCuestiones()[0];
        array_push($cuestiones, $cuestion);

            $form = $this->createForm(AspectoInternoType::class, $aspecto, array(
                'submit'=>'Guardar',
            ));
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $aspecto = $form->getData();
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($aspecto);
                $entityManager->flush();
                return $this->redirectToRoute('cuestiones_internas_dafo_list');
            }
        

        return  $this->render('cuestiones/internas/cuestion_dafo.html.twig', array(
            'form'=>$form->createView(),
            'title'=>'Editar ' . $aspecto->getDescripcion() . ' de la cuestion ' . $cuestion->getId(),
        ));

    }

    /**
     * @Route("/cuestiones/internas/dafo/nuevo/{id}"), name="aspectos_internos_nuevo"
     */
    public function addAspectosInternos(Request $request, $id){
        $cuestion = $this->getDoctrine()->getRepository(Cuestiones::class)
        ->find($id);
        $aspecto = new Aspectos();
        $form = $this->createForm(AspectoInternoType::class, $aspecto, array('submit'=>'Crear cuestion'));
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $aspecto = $form->getData();
            $aspecto->addAspectoCuestione($cuestion);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($aspecto);
            $entityManager->flush();
            return $this->redirectToRoute('cuestiones_internas_dafo_list');           
        }

        return $this->render('cuestiones/internas/cuestion_dafo.html.twig',array(
            'form'=>$form->createView(),
            'title' => 'Nuevo Aspecto',
        ));
    }

    /**
     * @Route("/cuestiones/externas/dafo/nuevo/{id}"), name="aspectos_externo_nuevo"
     */
    public function addAspectosExternos(Request $request, $id){
        $cuestion = $this->getDoctrine()->getRepository(Cuestiones::class)
        ->find($id);
        $aspecto = new Aspectos();
        $form = $this->createForm(AspectoExternoType::class, $aspecto, array('submit'=>'Crear cuestion'));
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $aspecto = $form->getData();
            $aspecto->setInterno(0);
            $aspecto->addAspectoCuestione($cuestion);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($aspecto);
            $entityManager->flush();
            return $this->redirectToRoute('cuestiones_externas_dafo_list');           
        }

        return $this->render('cuestiones/externas/cuestion_dafo.html.twig',array(
            'form'=>$form->createView(),
            'title' => 'Nuevo Aspecto',
        ));
    }

    /**
     * @Route("/cuestiones/externas/dafo/edita/{id}"), name="aspectos_externos_edit"
     */
    public function editAspectosExternos(Request $request, $id){
        $aspecto = $this->getDoctrine()->getRepository(Aspectos::class)
        ->find($id);
        $cuestiones = array();
        $cuestion = $aspecto->getAspectoCuestiones()[0];
        array_push($cuestiones, $cuestion);

            $form = $this->createForm(AspectoExternoType::class, $aspecto, array(
                'submit'=>'Guardar',
            ));
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $aspecto = $form->getData();
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($aspecto);
                $entityManager->flush();
                return $this->redirectToRoute('cuestiones_externas_dafo_list');
            }
        

        return  $this->render('cuestiones/externas/cuestion_dafo.html.twig', array(
            'form'=>$form->createView(),
            'title'=>'Editar ' . $aspecto->getDescripcion() . ' de la cuestion ' . $cuestion->getId(),
        ));

    }

}

?>