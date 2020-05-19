<?php
namespace App\Controller;

use App\Form\AspectoType;
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

class AspectosController extends AbstractController{
    /**
     * @Route("/cuestiones/internas/dafo/edita/{id}"), name="aspectos_edit"
     */
    public function editAspectosInternos(Request $request){
        $id = $request->request->get('id');
        $aspecto = $this->getDoctrine()->getRepository(Aspectos::class)
        ->find($id);
        if($request->isXmlHttpRequest() || $request->query->get('showJson') == 1){
            $form = $this->createForm(AspectoType::class, $aspecto, array(
                'submit'=>'Guardar'
            ));
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $aspecto = $form->getData();
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($aspecto);
                $entityManager->flush();
                return $this->redirectToRoute('/cuestiones/internas/dafo/list');
            }
        
        }
        return  $this->render('cuestiones/internas/cuestion.html.twig', array(
            'form'=>$form->createView(),
            'title'=>'Editar Aspecto'
        ));

    }

}

?>