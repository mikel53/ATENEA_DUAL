<?php
namespace App\Controller;

use App\Form\FactorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\FactoresRiesgo;
use App\Entity\Aspectos;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


use App\Entity\Cuestiones;
use App\Entity\Subtipos;
use App\Entity\Tipos;

class FactoresController extends AbstractController{

    /**
     * @Route("/factores/listOne/{id}", name="get_fce_one")
     */
    public function listOneFce($id){
        $factor = $this->getDoctrine()->getRepository(FactoresRiesgo::class)
        ->find($id);
        $aspectos = $factor->getFactoresRiesgoAspectos();
        return $this->render('factores/list_one.html.twig',['factor'=>$factor,'aspectos'=>$aspectos]);
    }
    /**
     * @Route("/factores/json", name="get_fce_json")
     */
    public function getAspectosJson(Request $request){
        if($request->isXmlHttpRequest()){
            $aspectosArr = $request->request->get("arr");
            return new JsonResponse($aspectosArr);
        }
    }

    /**
     * @Route("/factores/fce/list", name="get_fce")
     */

     public function getFactores(){
        $factores = $this->getDoctrine()->getRepository(FactoresRiesgo::class)
        ->findAll(); 
        return $this->render('factores/list_fce.html.twig', ['factores'=>$factores]);

     }
    /**
     * @Route("/factores/add/{arr}", name="list_fce")
     */
     public function addFactor(Request $request, $arr){
            
        $factor = new FactoresRiesgo();
        $form = $this->createForm(FactorType::class, $factor, array('submit'=>'Crear factor de riesgo'));
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $factor = $form->getData();
            $myArr = json_decode($arr, true);

            foreach($myArr as $aspecto){
                echo $aspecto;
                $aspecto = $this->getDoctrine()->getRepository(Aspectos::Class)
                ->find($aspecto);
                $factor->addFactoresRiesgoAspecto($aspecto);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($factor);
            $entityManager->flush();
            return $this->redirectToRoute('list_all_aspectos');           
        }

        return $this->render('factores/factor.html.twig',array(
            'form'=>$form->createView(),
            'title' => 'Nuevo Factor',
        ));
     }
}

?>