<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\component\Form\FormTypeInterface;

class DefaultController extends Controller
{

  /**
   * @Route("/", name="home")
   */
  public function home()
  {
    return $this->render('default/home.html.twig');
  }



}
