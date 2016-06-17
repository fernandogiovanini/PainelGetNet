<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 06/03/15
 * Time: 17:20
 */

namespace PainelGetNet\AppBundle\Twig;


use PainelGetNet\AppBundle\Entity\GetNet\Statement\Produto;

class ProdutoLabelExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('produto_label', array($this, 'produtoLabel')),
        );
    }

    public function produtoLabel($produtoValue)
    {
        return Produto::getLabel($produtoValue);
    }

    public function getName()
    {
        return 'getnet_produto_label_extension';
    }
}