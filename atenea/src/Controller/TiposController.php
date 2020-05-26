<?php
namespace App\Controller;

use App\Form\TipoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

use App\Entity\Tipos;
use App\Entity\UnidadGestion;

class TiposController extends AbstractController{


    /**
     * @Route("cuestiones/internas/list", name="cuestiones_internas_list")
     */

    public function list(Request $request){
        $id = $_GET["id"];
        $udGestion = $this->getDoctrine()->getRepository(UnidadGestion::class)->find($id);
        $usuario = $this->get('security.token_storage')->getToken()->getUser();
        $tipos = $this->getDoctrine()->getRepository(Tipos::Class)
        ->findByInternos();
        return $this->render('cuestiones/internas/list.html.twig', ["udGestion"=>$udGestion, 'tipos'=>$tipos]);
    }
    /**
     * @Route("cuestiones/externas/list", name="cuestiones_externas_list")
     */
    public function listExternas(Request $request){
        $id = $_GET["id"];
        $udGestion = $this->getDoctrine()->getRepository(UnidadGestion::class)->find($id);
        $usuario = $this->get('security.token_storage')->getToken()->getUser();
        $tipos = $this->getDoctrine()->getRepository(Tipos::Class)
        ->findByExternos();
        return $this->render('cuestiones/externas/list.html.twig', ["udGestion"=>$udGestion,'tipos'=>$tipos]);
    }

 

    /**
     * @Route("/tipos/nuevo", name="tipos_nuevo")
     */

     public function addTipo(Request $request){
        $id = $_GET["id"];
        $udGestion = $this->getDoctrine()->getRepository(UnidadGestion::class)->find($id);
        $tipo = new Tipos();
        $form = $this->createForm(TipoType::class, $tipo, array('submit'=>'Crear tipo'));
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $tipo = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tipo);
            $entityManager->flush();
            return $this->redirectToRoute('cuestiones_internas_list',['id' => $udGestion->getId()]);
        }
         return $this->render('tipos/tipo.html.twig',array(
            'form'=>$form->createView(),
            'title' => 'Nuevo Tipo',
        ));               
     }

     /**
      * @Route("/tipos/edita/{id}/{ugId}" , name="tipos_edita")
      */

      public function editTipo(Request $request, $id, $ugId){

        $udGestion = $this->getDoctrine()->getRepository(UnidadGestion::class)->find($ugId);

        $tipo = $this->getDoctrine()->getRepository(Tipos::class)
        ->find($id);

        $form = $this->createForm(TipoType::class, $tipo, array(
            'submit'=>'Guardar'
        ));
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $tipo = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tipo);
            $entityManager->flush();
            return $this->redirectToRoute('cuestiones_internas_list',['id' => $udGestion->getId()]);
        }
        return $this->render('tipos/tipo.html.twig', array(
            'form'=>$form->createView(),
            'title'=>'Editar Tipo',
        ));
      }
}

?>