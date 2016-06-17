<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 05/03/15
 * Time: 15:09
 */

namespace PainelGetNet\AppBundle\Entity\GetNet\Statement;

use Doctrine\ORM\EntityRepository;

class ResumoDeVendaRepository extends EntityRepository
{
    public function findVendasByHeader(Header $header)
    {
        $query = $this->_em->createQuery(
            'SELECT rv, t
            FROM PainelGetNetAppBundleGetNetStatement:ResumoDeVenda rv
            JOIN rv.transacoes t
            WHERE
              rv.header = :header AND
              ((rv.produto in (\'SE\',\'SR\') and rv.tipoDePagamento = \'PG\') or
               (rv.produto in (\'SV\',\'SM\') and rv.tipoDePagamento = \'PF\'))'
        );
        $query->setParameter('header', $header);

        return $query->getResult();
    }

    public function findConfirmacoesDePagamentosByHeader(Header $header)
    {
        $pg = $this->findPagamentosNormaisByHeader($header);
        $ac = $this->findAntecipacaoDeCreditoByHeader($header);
        $pr = $this->findPagamentoDeAntecipacaoDeCreditoByHeader($header);

        return array_merge($pg,$ac,$pr);
    }

    public function findPagamentosNormaisByHeader(Header $header)
    {
        $query = $this->_em->createQuery(
            'SELECT rv, t
            FROM PainelGetNetAppBundleGetNetStatement:ResumoDeVenda rv
            JOIN rv.transacoes t
            WHERE
              rv.header = :header AND
              (rv.produto in (\'SV\',\'SM\') and rv.tipoDePagamento in (\'PG\'))'
        );
        $query->setParameter('header', $header);
        return $query->getResult();
    }

    public function findAntecipacaoDeCreditoByHeader(Header $header)
    {
        $query = $this->_em->createQuery(
            'SELECT rv
            FROM PainelGetNetAppBundleGetNetStatement:ResumoDeVenda rv
            WHERE
              rv.header = :header AND
              (rv.produto in (\'SV\',\'SM\') and rv.tipoDePagamento in (\'AC\'))'
        );
        $query->setParameter('header', $header);
        return $query->getResult();
    }

    public function findPagamentoDeAntecipacaoDeCreditoByHeader(Header $header)
    {
        $query = $this->_em->createQuery(
            'SELECT rv
            FROM PainelGetNetAppBundleGetNetStatement:ResumoDeVenda rv
            WHERE
              rv.header = :header AND
              (rv.produto in (\'SV\',\'SM\') and rv.tipoDePagamento in (\'PR\'))'
        );
        $query->setParameter('header', $header);
        return $query->getResult();
    }

    public function findAjustesByHeader(Header $header)
    {
        $query = $this->_em->createQuery(
            'SELECT rv, a
            FROM PainelGetNetAppBundleGetNetStatement:ResumoDeVenda rv
            JOIN PainelGetNetAppBundleGetNetStatement:Ajuste a
            WHERE
              header = :header'
        );
        $query->setParameter('header', $header);
        return $query->getResult();
    }
}