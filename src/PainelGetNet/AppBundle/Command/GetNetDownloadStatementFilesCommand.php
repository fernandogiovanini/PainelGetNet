<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 03/03/15
 * Time: 10:22
 */

namespace PainelGetNet\AppBundle\Command;


use PainelGetNet\AppBundle\Entity\GetNet\Pagamento;
use PainelGetNet\AppBundle\Service\GetNet\PaymentsConfirmationService;
use League\Flysystem\Util;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GetNetDownloadStatementFilesCommand
 * Download the GetNet statement files for the current day
 *
 */
class GetNetDownloadStatementFilesCommand extends ContainerAwareCommand
{
    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName('getnet:statement:download')
            ->setDescription('Download the GetNet statement files for the current day')
            ->addArgument(
                'date',
                InputArgument::OPTIONAL,
                'Data do arquivo a ver baixado no formato ddmmyyyy. Deixar vazio para o dia atual.',
                'hoje')
            ->addOption(
                'skip-download',
                'sd',
                InputOption::VALUE_NONE,
                'Não faz o download do arquivo, considerando ele como existente no diretório');
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dataDoArquivo = $this->getDateArgument($input);

        if($this->arquivoExists($dataDoArquivo)){
            return null;
        }

        $skipDownload = $input->getOption('skip-download');

        try {
            $logger = $this->getContainer()->get('logger');
            $entityManager = $this->getContainer()->get('doctrine')->getManager();

            if(!$skipDownload) {
                $logger->debug('Inicio da rotina de download e importação do extrato GetNet');

                $logger->debug('Inicio da rotina de download do extrato GetNet');
                $downloadService = $this->getContainer()->get('getnet.statement_file_downloader');
                $downloadService->downloadFromDate($dataDoArquivo, $this->getContainer()->getParameter('getnet.statements_directory'));
                $logger->info('Rotina de download do extrato GetNet finalizada');
            }else{
                $logger->info('O download não será realizado pois o comando foi executado com a opção skip-download');
            }

            $logger->debug('Inicio da rotina de importação dos dados');
            $extractService = $this->getContainer()->get('getnet.statement_extractor');
            $arquivo = $extractService->extractFromDate($dataDoArquivo);
            $logger->debug('Fim da rotina de importação dos dados');

            $logger->debug('Persisitindo os dados extraídos do arquivo');
            $entityManager->persist($arquivo->getHeader());
            $entityManager->flush();
            $logger->debug('Dados gravados');

            $logger->debug('Carregando serviços e EM\'s');
            $paymentConfirmationService = $this->getContainer()->get('getnet.payment_confirmation');
            $resumoDeVendaRepository = $entityManager->getRepository('PainelGetNetAppBundleGetNetStatement:ResumoDeVenda');
            $headerRepository = $entityManager->getRepository('PainelGetNetAppBundleGetNetStatement:Header');
            $pagamentoRepository = $entityManager->getRepository('PainelGetNetAppBundleGetNet:Pagamento');
            $logger->debug('Fim do carregamento dos serviços e EM\'s');

            $logger->debug('Buscando o header por data de referência do movimento');
            $header = $headerRepository->findOneBy(['dataDeReferenciaDoMovimento' => $dataDoArquivo]);

            $logger->debug('Início da inserção de vendas');
            $vendas = $resumoDeVendaRepository->findVendasByHeader($header);
            $logger->debug('Extração de pagamentos futuros e pagamentos a vista');
            $payments = $paymentConfirmationService->extractPayments($vendas);
            $logger->debug('Persisitindo os dados de pagamentos futuros e pagamentos a vista');
            foreach($payments as $payment){
                $entityManager->persist($payment);
            }
            $entityManager->flush();
            $logger->debug('Dados de pagamentos futuros e pagamentos a vista gravados');

            $logger->debug('Início da confirmação de pagamentos');
            $confirmacoesDePagamentos = $resumoDeVendaRepository->findConfirmacoesDePagamentosByHeader($header);
            $logger->debug('Extração das confirmações de pagamentos');
            $payments = $paymentConfirmationService->extractPaymentsConfirmations($confirmacoesDePagamentos);
            $logger->debug('Persisitindo as confirmações de pagamentos');
            foreach($payments as $payment){
                $originalPayment = $pagamentoRepository->findOneBy(['numeroDoRv' => $payment->getNumeroDoRv(), 'parcela' => $payment->getParcela()]);
                if($originalPayment instanceof Pagamento){
                    $originalPayment->confirmPayment($payment);
                    $entityManager->persist($originalPayment);
                }else{
                    $logger->debug('Pagamento de venda que não existe na base. Inserindo venda.');
                    $entityManager->persist($payment);
                }
            }
            $entityManager->flush();
            $logger->debug('Dados das confirmações de pagamentos gravados');

        } catch (StatementFileNotFoundException $e) {
            $logger->debug('Arquivo não encontrado na GetNet');
            $logger->debug($e);
        } catch (\ErrorException $e) {
            $logger->error('Ocorreu um erro ao tentar baixar e importar arquivo da GetNet');
            $logger->error($e);
        } catch (\Exception $e) {
            $logger->error('Ocorreu um erro desconhecido ao tentar baixar e importar arquivo da GetNet');
            $logger->error($e);
        }finally{
            $logger->info('Rotina de download e importação do extrato GetNet finalizada');
        }
    }

    protected function getDateArgument(InputInterface $input){
        $date = $input->getArgument('date');
        if($date === 'hoje'){
            return new \DateTime();
        }
        return \DateTime::createFromFormat('dmY', $date);
    }

    protected function arquivoExists(\DateTime $date){
        $statementFileUtilService = $this->getContainer()->get('getnet.statement_file_util');
        $filename = $statementFileUtilService->getFilenameFromDate($date);

        $entityManager = $this->getContainer()->get('doctrine')->getManager();
        $arquivoRespository = $entityManager->getRepository('PainelGetNet\AppBundle\Entity\GetNet\Statement\Arquivo');
        $arquivos = $arquivoRespository->findBy(['nomeDoArquivo' => $filename]);
        return (bool) count($arquivos);
    }
}