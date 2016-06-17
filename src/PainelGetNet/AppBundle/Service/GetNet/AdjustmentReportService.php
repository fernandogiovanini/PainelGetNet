<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 05/03/15
 * Time: 17:44
 */

namespace PainelGetNet\AppBundle\Service\GetNet;

use Doctrine\ORM\EntityManagerInterface;

class AdjustmentReportService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    public function getSummaryByDate(\DateTime $start, \DateTime $end, $motivoDoAjuste)
    {
        $start = $start->format('Y-m-d 00:00:00');
        $end = $end->format('Y-m-d 23:59:59');

        $statement = $this->entityManager
            ->getConnection()
            ->prepare(
                "SELECT
                sum(a.valor_do_ajuste_com_sinal) as 'valor_do_ajuste_com_sinal',
                sum(a.valor_do_ajuste) as 'valor_do_ajuste'
            from getnet_statement_resumo_de_venda rv
            join getnet_statement_ajuste a on a.resumo_de_venda_id = rv.id
            where
                rv.data_do_resumo_de_venda between :start_date and :end_date
                and (
                    a.motivo_do_ajuste = :motivoDoAJuste
                )");
        $statement->bindParam('start_date', $start);
        $statement->bindParam('end_date', $end);
        $statement->bindParam('motivoDoAJuste', $motivoDoAjuste);
        $statement->execute();
        $result = $statement->fetchAll();
        return (count($result) > 0)?$result[0]:null;
    }
}