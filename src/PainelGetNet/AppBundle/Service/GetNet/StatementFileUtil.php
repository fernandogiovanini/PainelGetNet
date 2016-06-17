<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 04/03/15
 * Time: 15:37
 */

namespace PainelGetNet\AppBundle\Service\GetNet;
use League\Flysystem\Util;

/**
 * Class StatementFile
 *
 */
class StatementFileUtil
{

    private $merchandFileIdentification;
    private $localDirectory;

    public function __construct($merchandFileIdentification, $localDirectory)
    {
        $this->localDirectory = $localDirectory;
        $this->merchandFileIdentification = $merchandFileIdentification;
    }

    /**
     * Returns the statement filename
     *
     * Returns the filename based on the \DateTime
     * object and the merchandId
     *
     * @param \DateTime $dateTime
     * @return string
     */
    public function getFilenameFromDate(\DateTime $dateTime, $includeDirectory = true)
    {
        $directory = Util::normalizeRelativePath($includeDirectory ? $this->localDirectory . '/' : '');
        return "{$directory}extrato_eletronico_{$dateTime->format('Ymd')}-{$this->merchandFileIdentification}.txt";
    }
}