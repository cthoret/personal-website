<?php

namespace Clemac\PortfolioBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
            );    }

}
