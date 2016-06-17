<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 24/02/15
 * Time: 10:01
 */

namespace PainelGetNet\AppBundle\Controller;

use PainelGetNet\AppBundle\Entity\GetNet\Statement\Arquivo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class DefaultController extends Controller{

    /**
     *
     * @Route("/", name="default_index")
     * @Template()
     * @return array
     */
    public function indexAction(){

        return [];
    }

}