<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

  /**
   * @Route("/menu01", name="menu01")
   */
  public function menu01()
  {
    return $this->render('menus/menu01.html.twig');
  }
  /**
   * @Route("/menu0", name="menu0")
   */
  public function menu0()
  {
    return $this->render('menus/menu0.html.twig');

  }

}
