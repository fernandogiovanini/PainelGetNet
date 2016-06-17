<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 06/03/15
 * Time: 17:20
 */

namespace PainelGetNet\AppBundle\Twig;


use PainelGetNet\AppBundle\Entity\GetNet\StatusDoPagamento;

class StatusDoPagamentoLabelExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('status_do_pagamento_label', array($this, 'statusDoPagamentoLabel')),
        );
    }

    public function statusDoPagamentoLabel($statusDoPagamentoValue)
    {
        return StatusDoPagamento::getLabel($statusDoPagamentoValue);
    }

    public function getName()
    {
        return 'getnet_status_do_pagamento_label_extension';
    }
}