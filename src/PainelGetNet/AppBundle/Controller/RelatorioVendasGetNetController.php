<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 05/03/15
 * Time: 15:17
 */

namespace PainelGetNet\AppBundle\Controller;

use PainelGetNet\AppBundle\Entity\GetNet\Statement\Produto;
use PainelGetNet\AppBundle\Form\GetNet\Report\Type\SalesReportType;
use PainelGetNet\AppBundle\Service\GetNet\SalesReportService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class GetNetRelatorioController
 *
 * @Route("/getnet/relatorio", name="getnet_relatorio")
 */
class RelatorioVendasGetNetController extends Controller
{
    /**
     *
     * @Route(
     *      "/vendas",
     *      name="getnet_relatorio_vendas"
     * )
     * @Template()
     */
    public function relatorioAction(Request $request)
    {
        $form = $this->createForm(new SalesReportType());
        $form->handleRequest($request);
        $pagination = null;
        $panelData = null;
        $summaryTableData = null;

        if ($form->isValid()) {
            $startDate = $form->get('start_date')->getData();
            $endDate = $form->get('end_date')->getData();

            $salesReportService = new SalesReportService($this->getDoctrine()->getManager());
            $resumosDeVendasResult = $salesReportService->getReportByDate($startDate, $endDate);
            $panelData = $salesReportService->getSummaryByDate($startDate, $endDate);
            $summaryTableData = $salesReportService->getSalesByProdutoSummaryByDate($startDate, $endDate);
            $summaryTableData = $salesReportService->formatSalesByProdutoSummary($summaryTableData);

            $paginator = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $resumosDeVendasResult,
                $request->query->get('page', 1),
                20
            );
        }

        return [
            'form' => $form->createView(),
            'resumosDeVendas' => $pagination,
            'panelData' => $panelData,
            'summaryTableData' => $summaryTableData,
        ];
    }

    /**
     *
     * @Route(
     *      "/vendas/download/{startDate}/{endDate}/",
     *      name="getnet_relatorio_vendas_download"
     * )
     */
    public function downlaodRelatorioCsvAction(\DateTime $startDate, \DateTime $endDate)
    {
        $salesReportService = new SalesReportService($this->getDoctrine()->getManager());
        $resumosDeVendasResult = $salesReportService->getReportByDate($startDate, $endDate);

        $response = new StreamedResponse();
        $response->setCallback(function () use ($resumosDeVendasResult) {
            $handle = fopen('php://output', 'w+');
            fputcsv($handle, ['Numero do registro de venda', 'Forma de pagamento', 'Data da venda', 'Valor da venda', 'Valor líquido', 'Taxa calculada', 'Total de parcelas'], ';');
            foreach($resumosDeVendasResult as $resumoDeVenda){
                fputcsv($handle,[
                    $resumoDeVenda['numeroDoResumoDaVenda'],
                    Produto::getLabel($resumoDeVenda['produto']),
                    \DateTime::createFromFormat('Y-m-d', $resumoDeVenda['dataHoraDaTransacao'])->format('d/m/Y'),
                    number_format($resumoDeVenda['valorDaTransacao'], 2, ',', '.'),
                    number_format($resumoDeVenda['valorLiquido'], 2, ',', '.'),
                    number_format($resumoDeVenda['taxa_calculada']*100, 2, ',', '.') . '%',
                    $resumoDeVenda['totalDeParcelas'],
                    ],
                ';');
            }
            fclose($handle);
        });

        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'text/csv; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment; filename="relatorio_vendas.csv"');

        return $response;
    }

}