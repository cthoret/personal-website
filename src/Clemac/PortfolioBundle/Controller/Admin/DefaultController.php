<?php

namespace Clemac\PortfolioBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Clemac\PortfolioBundle\Entity\Achievement;
use Clemac\PortfolioBundle\Entity\Video;

class DefaultController extends Controller
{
    /**
     * @Route("/dashboard", name="clemac_portfolio_admin_dashboard")
     * @Template()
     */
    public function dashboardAction()
    {
        return array(
                // ...
            );
    }

     /**
     * @Route("/menu_render")
     * @Template("ClemacPortfolioBundle:Admin/Default:_menu.html.twig")
     */
    public function menuAction()
    {
        $em = $this->getDoctrine()->getManager();

        $nbAchievement = $em->getRepository('ClemacPortfolioBundle:Achievement')->countEntities();
        $nbVideo = $em->getRepository('ClemacPortfolioBundle:Video')->countEntities();

        return array(
            'nbAchievement' => $nbAchievement,
            'nbVideo' => $nbVideo
        );
    }
}
