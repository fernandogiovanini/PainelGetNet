<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 09/03/15
 * Time: 16:51
 */

namespace PainelGetNet\AppBundle\Entity\GetNet;

use Doctrine\ORM\EntityRepository;

class PagamentoRepository extends EntityRepository
{
    public function getQueryFindByDataProgramadaDoPagamento($startDate, $endDate)
    {
        $startDate = $startDate->format('Y-m-d 00:00:00');
        $endDate = $endDate->format('Y-m-d 23:59:59');

        $query = $this->_em->createQuery(
            'SELECT p
            FROM PainelGetNetAppBundleGetNet:Pagamento p
            WHERE
              (p.dataDoPagamento BETWEEN  :start_date AND :end_date AND p.statusDoPagamento = :pago ) OR
              (p.dataProgramadaDoPagamento BETWEEN  :start_date AND :end_date AND p.statusDoPagamento = :a_receber)'
        );
        $query->setParameter('start_date', $startDate);
        $query->setParameter('end_date', $endDate);
        $query->setParameter('pago', StatusDoPagamento::PAGO);
        $query->setParameter('a_receber', StatusDoPagamento::A_RECEBER);

        return $query;
    }

    public function findByDataProgramadaDoPagamento($startDate, $endDate)
    {
        return $this->getQueryFindByDataProgramadaDoPagamento($startDate, $endDate)->getResult();
    }

    public function findPagoSummaryByDataDoPagamento($startDate, $endDate)
    {
        $startDate = $startDate->format('Y-m-d 00:00:00');
        $endDate = $endDate->format('Y-m-d 23:59:59');

        $query = $this->_em->createQuery(
            'SELECT
              p.tipoDeMovimento,
              sum(p.valorAReceber) as recebido,
              sum(p.valorDeTaxaDeDesconto) as pago
            FROM PainelGetNetAppBundleGetNet:Pagamento p
            WHERE
              (p.dataDoPagamento BETWEEN  :start_date AND :end_date AND p.statusDoPagamento = :pago )
            GROUP BY p.tipoDeMovimento'
        );
        $query->setParameter('start_date', $startDate);
        $query->setParameter('end_date', $endDate);
        $query->setParameter('pago', StatusDoPagamento::PAGO);

        $summary = [
            'PG' => [
                'recebido' =>null,
                'pago' =>null
            ], 
            'AC' => [
                'recebido' =>null,
                'pago' =>null
            ]
        ];  

        $result =  $query->getResult();
        foreach ($result as $pagamento) {
            $summary[$pagamento['tipoDeMovimento']]['recebido'] = $pagamento['recebido'];
            $summary[$pagamento['tipoDeMovimento']]['pago'] = $pagamento['pago'];            
        }

        return $summary;
    }

    public function findAReceberSummaryByDataDoPagamento($startDate, $endDate)
    {
        $startDate = $startDate->format('Y-m-d 00:00:00');
        $endDate = $endDate->format('Y-m-d 23:59:59');

        $query = $this->_em->createQuery(
            'SELECT
              sum(p.valorAReceber) as a_receber,
              sum(p.valorDeTaxaDeDesconto) as a_pagar
            FROM PainelGetNetAppBundleGetNet:Pagamento p
            WHERE
              (p.dataProgramadaDoPagamento BETWEEN  :start_date AND :end_date AND p.statusDoPagamento = :a_receber)'
        );
        $query->setParameter('start_date', $startDate);
        $query->setParameter('end_date', $endDate);
        $query->setParameter('a_receber', StatusDoPagamento::A_RECEBER);

        return $query->getOneOrNullResult();
    }

    public function findPagamentosRecebidosByProdutoSummaryByDate($startDate, $endDate){
        $startDate = $startDate->format('Y-m-d 00:00:00');
        $endDate = $endDate->format('Y-m-d 23:59:59');

        $query = $this->_em->createQuery(
            'SELECT
                p.produto,
                p.tipoDeMovimento,
                SUM(p.valorParaOCliente) AS recebido,
                SUM(p.valorDeTaxaDeDesconto + p.valorDeTaxaDeServico) AS taxa,
                SUM(p.valorPago) AS valor_liquido
            FROM PainelGetNetAppBundleGetNet:Pagamento p
            WHERE
                p.statusDoPagamento = :pago
                AND p.dataDoPagamento BETWEEN :start_date AND :end_date
            GROUP BY p.produto, p.tipoDeMovimento'
        );
        $query->setParameter('start_date', $startDate);
        $query->setParameter('end_date', $endDate);
        $query->setParameter('pago', StatusDoPagamento::PAGO);

        return $result =  $query->getResult();
    }

    public function formatPagamentosRecebidosByProdutoSummary($result)
    {
        $summary = [
            'SV' => [
                'recebido_normal' => null,
                'recebido_antecipado' => null,
                'recebido_total' => null,
                'taxas_normal' => null,
                'taxas_antecipado' => null,
                'taxas_total' => null,
                'valor_liquido' => null
            ],
            'SM' => [
                'recebido_normal' => null,
                'recebido_antecipado' => null,
                'recebido_total' => null,
                'taxas_normal' => null,
                'taxas_antecipado' => null,
                'taxas_total' => null,
                'valor_liquido' => null
            ],
            'SE' => [
                'recebido_normal' => null,
                'recebido_antecipado' => null,
                'recebido_total' => null,
                'taxas_normal' => null,
                'taxas_antecipado' => null,
                'taxas_total' => null,
                'valor_liquido' => null
            ],
            'SR' => [
                'recebido_normal' => null,
                'recebido_antecipado' => null,
                'recebido_total' => null,
                'taxas_normal' => null,
                'taxas_antecipado' => null,
                'taxas_total' => null,
                'valor_liquido' => null
            ],
            'total' => [
                'recebido_normal' => null,
                'recebido_antecipado' => null,
                'recebido_total' => null,
                'taxas_normal' => null,
                'taxas_antecipado' => null,
                'taxas_total' => null,
                'valor_liquido' => null
            ]
        ];

        foreach ($result as $pagamento) {
            if($pagamento['tipoDeMovimento'] == TipoDeMovimento::ANTECIPACAO_DE_CREDITO){
                $summary[$pagamento['produto']]['recebido_antecipado'] = $pagamento['recebido'];
                $summary[$pagamento['produto']]['taxas_antecipado'] += $pagamento['taxa'];

                $summary['total']['recebido_antecipado'] += $pagamento['recebido'];
                $summary['total']['taxas_antecipado'] += $pagamento['taxa'];
            }else{
                $summary[$pagamento['produto']]['recebido_normal'] = $pagamento['recebido'];
                $summary[$pagamento['produto']]['taxas_normal'] += $pagamento['taxa'];

                $summary['total']['recebido_normal'] += $pagamento['recebido'];
                $summary['total']['taxas_normal'] += $pagamento['taxa'];
            }
            $summary[$pagamento['produto']]['recebido_total'] += $pagamento['recebido'];
            $summary[$pagamento['produto']]['taxas_total'] += $pagamento['taxa'];
            $summary[$pagamento['produto']]['valor_liquido'] += $pagamento['valor_liquido'];

            $summary['total']['recebido_total'] += $pagamento['recebido'];
            $summary['total']['taxas_total'] += $pagamento['taxa'];
            $summary['total']['valor_liquido'] += $pagamento['valor_liquido'];
        }
        return $summary;
    }

    public function findPagamentosAReceberByProdutoSummaryByDate($startDate, $endDate){
        $startDate = $startDate->format('Y-m-d 00:00:00');
        $endDate = $endDate->format('Y-m-d 23:59:59');

        $query = $this->_em->createQuery(
            'SELECT
                p.produto,
                SUM(p.valorParaOCliente) AS a_receber,
                SUM(p.valorDeTaxaDeDesconto + p.valorDeTaxaDeServico) AS taxa,
                SUM(p.valorParaOCliente) - (SUM(p.valorDeTaxaDeDesconto + p.valorDeTaxaDeServico)) AS valor_liquido
            FROM PainelGetNetAppBundleGetNet:Pagamento p
            WHERE
                p.statusDoPagamento = :a_receber
                AND p.dataProgramadaDoPagamento BETWEEN :start_date AND :end_date
            GROUP BY p.produto'
        );
        $query->setParameter('start_date', $startDate);
        $query->setParameter('end_date', $endDate);
        $query->setParameter('a_receber', StatusDoPagamento::A_RECEBER);

        return $result =  $query->getResult();
    }

    public function formatPagamentosAReceberByProdutoSummary($result)
    {
        $summary = [
            'SV' => [
                'a_receber' => null,
                'taxas' => null,
                'valor_liquido' => null
            ],
            'SM' => [
                'a_receber' => null,
                'taxas' => null,
                'valor_liquido' => null
            ],
            'total' => [
                'a_receber' => null,
                'taxas' => null,
                'valor_liquido' => null
            ]
        ];

        foreach ($result as $pagamento) {
            $summary[$pagamento['produto']]['a_receber'] += $pagamento['a_receber'];
            $summary[$pagamento['produto']]['taxas'] += $pagamento['taxa'];
            $summary[$pagamento['produto']]['valor_liquido'] += $pagamento['valor_liquido'];

            $summary['total']['a_receber'] += $pagamento['a_receber'];
            $summary['total']['taxas'] += $pagamento['taxa'];
            $summary['total']['valor_liquido'] += $pagamento['valor_liquido'];
        }
        return $summary;
    }
}