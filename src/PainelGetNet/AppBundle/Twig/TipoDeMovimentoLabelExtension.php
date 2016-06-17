<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 06/03/15
 * Time: 17:20
 */

namespace PainelGetNet\AppBundle\Twig;


use PainelGetNet\AppBundle\Entity\GetNet\TipoDeMovimento;

class TipoDeMovimentoLabelExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('tipo_de_movimento_label', array($this, 'tipoDeMovimentoLabel')),
        );
    }

    public function tipoDeMovimentoLabel($tipoDeMovimentoValue)
    {
        return TipoDeMovimento::getLabel($tipoDeMovimentoValue);
    }

    public function getName()
    {
        return 'getnet_tipo_de_movimento_label_extension';
    }
}