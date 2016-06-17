<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 03/03/15
 * Time: 12:51
 */

namespace PainelGetNet\AppBundle\Service\GetNet;

use PainelGetNet\AppBundle\Exception\GetNet\StatementFileNotFoundException;
use PainelGetNet\AppBundle\Util\GetNet\StatementFile;
use League\Flysystem\FilesystemInterface;
use League\Flysystem\Util;
use Psr\Log\LoggerInterface;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class StatementFileDownloaderService
 *
 * Downloads a statement file and move it to
 * a local filesystem directory
 */
class StatementFileDownloaderService
{
    private $remoteFilesystem;
    private $localFilesystem;
    private $statementFileUtil;
    protected $logger;

    /**
     * @param FilesystemInterface $remoteFilesystem
     * @param Filesystem $localFilesystem
     */
    public function __construct(FilesystemInterface $remoteFilesystem, Filesystem $localFilesystem, StatementFileUtil $statementFileUtil)
    {
        $this->setRemoteFilesystem($remoteFilesystem);
        $this->setLocalFilesystem($localFilesystem);
        $this->setStatementFileUtil($statementFileUtil);
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
     * Set the remote filesystem
     *
     * @param FilesystemInterface $remoteFilesystem
     */
    public function setRemoteFilesystem(FilesystemInterface $remoteFilesystem)
    {
        $this->remoteFilesystem = $remoteFilesystem;
    }

    /**
     * Set the local filesystem
     *
     * @param Filesystem $localFilesystem
     */
    public function setLocalFilesystem(Filesystem $localFilesystem)
    {
        $this->localFilesystem = $localFilesystem;
    }

    public function setStatementFileUtil(StatementFileUtil $statementFileUtil)
    {
        $this->statementFileUtil = $statementFileUtil;
    }

    /**
     * Download a GetNet statement file from a date
     *
     * Receives the statement creation date as parameter
     *
     * @param \DateTime $dateTime
     * @param mixed $localTargetDirectory
     */
    public function downloadFromDate(\DateTime $dateTime, $localTargetDirectory)
    {
        try {
            $this->verifyLogger();
            $this->logger->info('Download do extrato GetNet por data');
            $filename = $this->statementFileUtil->getFilenameFromDate($dateTime, false);
            $this->downloadFile($filename, $localTargetDirectory);
        } catch (\ErrorException $e) {
            throw new \ErrorException("Não foi possível gravar o arquivo da GetNet do dia {$dateTime->format('d/m/Y')}" );
        } catch (\Exception $e) {
            $this->logger->info($e);
        }
    }

    /**
     * Download an statement file
     *
     * @param $filename
     * @param $localTargetDirectory
     * @throws StatementFileNotFoundException
     * @throws \ErrorException
     */
    public function downloadFile($filename, $localTargetDirectory)
    {
        try {
            $this->verifyLogger();

            if (!$this->remoteFilesystem->has($filename)) {
                throw new StatementFileNotFoundException("Arquivo {$filename} não encontrado", 404);
            }

            $localFilename = Util::normalizeRelativePath($localTargetDirectory . '/' . $filename);
            if (!$this->localFilesystem->exists($localFilename)) {
                $this->localFilesystem->dumpFile($localFilename, $this->remoteFilesystem->read($filename));
                $this->logger->info("Extrato {$localFilename} baixado");
            } else {
                $this->logger->info("Extrato {$localFilename} encontrado");
            }
        } catch (IOException $e) {
            $this->logger->error($e);
            throw new \ErrorException("Atenção! Não foi possível gravar o arquivo {$filename} da GetNet");
        }
    }

    /**
     * Verify if a logger was instantiated
     *
     * @throws \ErrorException
     */
    protected function verifyLogger(){
        if (!$this->logger instanceof LoggerInterface) {
            throw new \ErrorException('Um logger deve ser informado para usar o serviço StatementFileDownloaderService');
        }
    }
}