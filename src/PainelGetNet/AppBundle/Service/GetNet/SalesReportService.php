<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 05/03/15
 * Time: 17:44
 */

namespace PainelGetNet\AppBundle\Service\GetNet;

use Doctrine\ORM\EntityManagerInterface;

class SalesReportService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    public function getReportByDate(\DateTime $start, \DateTime $end)
    {
        $start = $start->format('Y-m-d 00:00:00');
        $end = $end->format('Y-m-d 23:59:59');

        $statement = $this->entityManager
            ->getConnection()
            ->prepare(
                "SELECT
                rv.numero_do_resumo_de_vendas as numeroDoResumoDaVenda,
                rv.quantidade_de_parcelas_do_resumo_de_venda as totalDeParcelas,
                rv.produto as produto,
                rv.data_do_resumo_de_venda as dataHoraDaTransacao,
                sum(rv.valor_bruto) as valorDaTransacao,
                sum(rv.valor_liquido) as valorLiquido,
                ((sum(rv.valor_bruto)-sum(rv.valor_liquido))/sum(rv.valor_bruto)) as 'taxa_calculada'
            from getnet_statement_resumo_de_venda rv
            where
                rv.data_do_resumo_de_venda between :start_date and :end_date
                and (
                    (rv.produto in ('SE','SR') and rv.tipo_de_pagamento = 'PG') or
                    (rv.produto in ('SV','SM') and rv.tipo_de_pagamento = 'PF')
                )
            group by
                rv.numero_do_resumo_de_vendas,
                rv.quantidade_de_parcelas_do_resumo_de_venda,
                rv.produto");
        $statement->bindParam('start_date', $start);
        $statement->bindParam('end_date', $end);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getSummaryByDate(\DateTime $start, \DateTime $end)
    {
        $start = $start->format('Y-m-d 00:00:00');
        $end = $end->format('Y-m-d 23:59:59');

        $statement = $this->entityManager
            ->getConnection()
            ->prepare(
                "SELECT
                sum(rv.valor_bruto) as 'faturado',
                sum(rv.valor_liquido) as 'a_receber',
                sum(rv.valor_da_taxa_de_desconto) as 'a_pagar'
            from getnet_statement_resumo_de_venda rv
            where
                rv.data_do_resumo_de_venda between :start_date and :end_date
                and (
                    (rv.produto in ('SE','SR') and rv.tipo_de_pagamento = 'PG') or
                    (rv.produto in ('SV','SM') and rv.tipo_de_pagamento = 'PF')
                )");
        $statement->bindParam('start_date', $start);
        $statement->bindParam('end_date', $end);
        $statement->execute();
        $result = $statement->fetchAll();
        return (count($result) > 0)?$result[0]:null;
    }

    public function getSalesByProdutoSummaryByDate(\DateTime $start, \DateTime $end)
    {
        $start = $start->format('Y-m-d 00:00:00');
        $end = $end->format('Y-m-d 23:59:59');

        $statement = $this->entityManager
            ->getConnection()
            ->prepare(
                "SELECT
                rv.produto as produto,
                sum(rv.valor_bruto) as 'faturado',
                sum(rv.valor_liquido) as 'a_receber',
                sum(rv.valor_da_taxa_de_desconto) as 'a_pagar'
            from getnet_statement_resumo_de_venda rv
            where
                rv.data_do_resumo_de_venda between :start_date and :end_date
                and (
                    (rv.produto in ('SE','SR') and rv.tipo_de_pagamento = 'PG') or
                    (rv.produto in ('SV','SM') and rv.tipo_de_pagamento = 'PF')
                )
            group by rv.produto");
        $statement->bindParam('start_date', $start);
        $statement->bindParam('end_date', $end);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function formatSalesByProdutoSummary($result)
    {
        $summary = [
            'total' => [
                'faturado' => 0,
                'a_receber' => 0,
                'a_pagar' => 0
            ]
        ];

        foreach ($result as $line) {
            $summary[$line['produto']] = [];
            $summary[$line['produto']]['faturado'] = $line['faturado'];
            $summary[$line['produto']]['a_pagar'] = $line['a_pagar'];
            $summary[$line['produto']]['a_receber'] = $line['a_receber'];

            $summary['total']['faturado'] += $line['faturado'];
            $summary['total']['a_pagar'] += $line['a_pagar'];
            $summary['total']['a_receber'] += $line['a_receber'];
        }
        return $summary;
    }
}