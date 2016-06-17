<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 04/03/15
 * Time: 15:15
 */

namespace PainelGetNet\AppBundle\Service\GetNet;

use PainelGetNet\AppBundle\Entity\GetNet\Statement\AjusteFactory;
use PainelGetNet\AppBundle\Entity\GetNet\Statement\Arquivo;
use PainelGetNet\AppBundle\Entity\GetNet\Statement\HeaderFactory;
use PainelGetNet\AppBundle\Entity\GetNet\Statement\ResumoDeVenda;
use PainelGetNet\AppBundle\Entity\GetNet\Statement\ResumoDeVendaFactory;
use PainelGetNet\AppBundle\Entity\GetNet\Statement\TransacaoFactory;
use PainelGetNet\AppBundle\Exception\GetNet\FileStructureException;
use Psr\Log\LoggerInterface;

/**
 * Class StatementExtractorService
 *
 * Extracts a GetNet statement from the
 * statmente file
 */
class StatementExtractorService
{
    private $statementFileUtil;
    protected $logger;

    /**
     * @param StatementFileUtil $statementFileUtil
     */
    public function __construct(StatementFileUtil $statementFileUtil)
    {
        $this->setStatementFileUtil($statementFileUtil);
    }

    /**
     * @param StatementFileUtil $statementFileUtil
     */
    public function setStatementFileUtil(StatementFileUtil $statementFileUtil)
    {
        $this->statementFileUtil = $statementFileUtil;
    }

    /**
     * Set the logger interface
     *
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Extracts data from a statement file
     *
     * Extracts the content of a GetNet statement file
     * by the file's date. The file must be in the GetNet
     * download directory.
     *
     * @param \DateTime $dateTime
     * @return Arquivo
     */
    public function extractFromDate(\DateTime $dateTime)
    {
        try {
            $this->verifyLogger();
            $this->logger->info('Importar estrato GetNet por data');
            $arquivo = new Arquivo($this->statementFileUtil->getFilenameFromDate($dateTime));
            return $this->extract($arquivo);
        } catch(FileStructureException $e){
            $this->logger->critical($e);
            throw new \ErrorException("A estrutura do arquivo é inválida");
        }
        catch (\Exception $e) {
            $this->logger->error($e);
        }
    }

    /**
     * Extracts the content of a statement file
     *
     * Reads the file a extract the Header, ResumoDeVenda,
     * Transacao and Ajuste objects related to the statement
     *
     * @param Arquivo $arquivo
     *
     * @return Arquivo
     *
     * @throws FileStructureException
     */
    public function extract(Arquivo $arquivo)
    {
        $this->verifyLogger();

        $headerFactory = new HeaderFactory();
        $resumoDeVendaFactory = new ResumoDeVendaFactory();
        $transacaoFactory = new TransacaoFactory();
        $ajusteFactory = new AjusteFactory();

        $header = null;
        $ultimoResumoDeVenda = null;

        $handler = $arquivo->getFileHandler();
        while (!$handler->eof()) {
            $line = $handler->fgets();

            $lineType = $this->getLineType($line);
            switch ($lineType) {

                case '0':
                    $this->logger->info('Header encontrado');
                    $header = $headerFactory->createFromStatementLine($line);
                    $arquivo->setHeader($header);
                    break;

                case '1':
                    $this->logger->info('RV encontrado');
                    $resumoDeVenda = $resumoDeVendaFactory->createFromStatementLine($line);
                    $header->addResumoDeVenda($resumoDeVenda);
                    $ultimoResumoDeVenda = $resumoDeVenda;
                    break;

                case '2':
                    $this->logger->info('Transação encontrada');
                    $transacao = $transacaoFactory->createFromStatementLine($line);
                    if (!$ultimoResumoDeVenda instanceof ResumoDeVenda) {
                        throw new FileStructureException("Registro de transação não possui Resumo de Vendas: {$line}");
                    }
                    $ultimoResumoDeVenda->addTransacao($transacao);
                    break;

                case '3':
                    $this->logger->info('Ajuste encontrado');
                    $ajuste = $ajusteFactory->createFromStatementLine($line);
                    if (!$ultimoResumoDeVenda instanceof ResumoDeVenda) {
                        throw new FileStructureException("Ajuste não possui Resumo de Vendas: {$line}");
                    }
                    $ultimoResumoDeVenda->addAjuste($ajuste);
                    break;

                default:
                    $this->logger->info('Trailler ou linha vazia encontrada');
                    break;
            }
        }
        return $arquivo;
    }

    /**
     * Returns the first char in the line
     *
     * The first char represents the line type.
     * Possible values are:
     * - 0: Header
     * - 1: ResumoDeVendas
     * - 2: Transacao
     * - 3: Ajuste
     * - 9: Trailler
     * - null: Other line (ex: empty line)
     *
     * @param $line
     *
     * @return string
     *
     */
    private function getLineType($line){
        return (strlen($line) > 0) ? $line[0] : null;
    }

    /**
     * Verify if a logger was instantiated
     *
     * @throws \ErrorException
     */
    protected function verifyLogger()
    {
        if (!$this->logger instanceof LoggerInterface) {
            throw new \ErrorException('Um logger deve ser informado para usar o serviço StatementExtractorService');
        }
    }
}