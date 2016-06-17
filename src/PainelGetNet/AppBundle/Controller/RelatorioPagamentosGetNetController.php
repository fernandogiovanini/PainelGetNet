<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 05/03/15
 * Time: 15:17
 */

namespace PainelGetNet\AppBundle\Controller;

use PainelGetNet\AppBundle\Entity\GetNet\Pagamento;
use PainelGetNet\AppBundle\Entity\GetNet\Statement\MotivoDoAjuste;
use PainelGetNet\AppBundle\Entity\GetNet\Statement\Produto;
use PainelGetNet\AppBundle\Entity\GetNet\StatusDoPagamento;
use PainelGetNet\AppBundle\Entity\GetNet\TipoDeMovimento;
use PainelGetNet\AppBundle\Form\GetNet\Report\Type\PaymentsReportType;
use PainelGetNet\AppBundle\Service\GetNet\AdjustmentReportService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class RelatorioPagamentosGetNetController
 *
 * @Route("/getnet/relatorio", name="getnet_relatorio")
 */
class RelatorioPagamentosGetNetController extends Controller
{
    /**
     * @Route(
     *      "/pagamentos/",
     *      name="getnet_relatorio_pagamentos"
     * )
     * @Template()
     */
    public function relatorioAction(Request $request)
    {
        $form = $this->createForm(new PaymentsReportType());
        $form->handleRequest($request);
        $pagination = null;
        $aluguelDaPos = null;
        $pagoPorProdutoSummary = null;
        $aReceberPorProdutoSummary = null;

        if ($form->isValid()) {
            $startDate = $form->get('start_date')->getData();
            $endDate = $form->get('end_date')->getData();

            $pagamentoRepository = $this->getDoctrine()->getRepository('PainelGetNetAppBundleGetNet:Pagamento');
            $pagamentos = $pagamentoRepository->getQueryFindByDataProgramadaDoPagamento($startDate, $endDate);


            $pagoPorProdutoSummary = $pagamentoRepository->findPagamentosRecebidosByProdutoSummaryByDate($startDate, $endDate);
            $pagoPorProdutoSummary = $pagamentoRepository->formatPagamentosRecebidosByProdutoSummary($pagoPorProdutoSummary);

            $aReceberPorProdutoSummary = $pagamentoRepository->findPagamentosAReceberByProdutoSummaryByDate($startDate, $endDate);
            $aReceberPorProdutoSummary = $pagamentoRepository->formatPagamentosAReceberByProdutoSummary($aReceberPorProdutoSummary);


            $adjustmentReportService = new AdjustmentReportService($this->getDoctrine()->getManager());
            $aluguelDaPos = $adjustmentReportService->getSummaryByDate($startDate, $endDate, MotivoDoAjuste::ALUGUEL_DE_POS);

            $paginator = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $pagamentos,
                $request->query->get('page', 1),
                20
            );
        }

        return [
            'form' => $form->createView(),
            'pagamentos' => $pagination,
            'aluguelDaPos' => $aluguelDaPos,


            'pagoPorProdutoSummary' => $pagoPorProdutoSummary,
            'aReceberPorProdutoSummary' => $aReceberPorProdutoSummary
        ];
    }

    /**
     * @Route(
     *      "/pagamentos/download/{startDate}/{endDate}/",
     *      name="getnet_relatorio_pagamentos_download"
     * )
     */
    public function downlaodRelatorioCsvAction(\DateTime $startDate, \DateTime $endDate)
    {
        $pagamentoRepository = $this->getDoctrine()->getRepository('PainelGetNetAppBundleGetNet:Pagamento');
        $pagamentosResult = $pagamentoRepository->findByDataProgramadaDoPagamento($startDate, $endDate);

        $response = new StreamedResponse();
        $response->setCallback(function () use ($pagamentosResult) {
            $handle = fopen('php://output', 'w+');
            fputcsv($handle, ['Número do registro de venda', 'Forma de pagamento', 'Data do pagamento', 'Data da venda', 'Parcela', 'Valor a receber', 'Valor recebido', 'Taxa GetNet', 'Tipo de pagamento', 'Status do pagamento'], ';');
            foreach($pagamentosResult as $pagamento){
                fputcsv($handle,[
                        $pagamento->getNumeroDoRv(),
                        Produto::getLabel($pagamento->getProduto()),
                        $pagamento->getDataProgramadaDoPagamento()->format('d/m/Y'),
                        $pagamento->getDataDaVenda()->format('d/m/Y'),
                        $pagamento->getParcela() .'/'.$pagamento->getTotalDeParcelas(),
                        number_format($pagamento->getValorAReceber(), 2, ',', '.'),
                        number_format($pagamento->getValorPago(), 2, ',', '.'),
                        number_format($pagamento->getValorDeTaxaDeDesconto(), 2, ',', '.'),
                        TipoDeMovimento::getLabel($pagamento->getTipoDeMovimento()),
                        StatusDoPagamento::getLabel($pagamento->getStatusDoPagamento())
                    ],
                ';');
            }
            fclose($handle);
        });

        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'text/csv; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment; filename="relatorio_pagamentos.csv"');

        return $response;
    }

}