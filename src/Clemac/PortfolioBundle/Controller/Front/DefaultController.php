<?php

namespace Clemac\PortfolioBundle\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="clemac_portfolio_front_home")
     */
    public function indexAction()
    {
        return $this->render('ClemacPortfolioBundle:Front/Default:home.html.twig', [
        ]);
    }
}
