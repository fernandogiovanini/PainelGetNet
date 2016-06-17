<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 03/03/15
 * Time: 18:21
 */

namespace PainelGetNet\AppBundle\Entity\GetNet\Statement;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * GetNet Statement file
 *
 * @ORM\Entity(repositoryClass="PainelGetNet\AppBundle\Entity\GetNet\Statement\ArquivoRepository")
 * @ORM\Table(name="getnet_statement_arquivo")
 */
class Arquivo
{
    /**
     * @var File ID
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Created at
     *
     * @ORM\Column(
     *      type="datetime",
     *      name="data_de_criacao"
     * )
     * @Assert\Date()
     */
    protected $dataDeCriacao;

    /**
     * @var GetNet statement filename
     *
     * @ORM\Column(
     *      type="string",
     *      name="nome_do_arquivo",
     *      length=200,
     *      unique=true
     * )
     * @Assert\Type(type="string", message="O nome do arquivo deve ser texto")
     */
    protected $nomeDoArquivo;

    /**
     * @var Header File header
     *
     * @ORM\OneToOne(
     *      targetEntity="PainelGetNet\AppBundle\Entity\GetNet\Statement\Header",
     *      mappedBy="arquivo",
     *      cascade={"persist"}
     * )
     */
    protected $header;

    /**
     * @param string $nomeDoArquivo
     */
    public function __construct($nomeDoArquivo)
    {
        if(is_null($nomeDoArquivo)){
            throw new \InvalidArgumentException("O nome do arquivo deve ser informado");
        }
        $this->setNomeDoArquivo($nomeDoArquivo);
        $this->setDataDeCriacao(new \DateTime());
    }

    /**
     * Created at datetime
     *
     * @param \DateTime $dataDeCriacao
     */
    private function setDataDeCriacao(\DateTime $dataDeCriacao)
    {
        $this->dataDeCriacao = $dataDeCriacao;
    }

    /**
     * @param string $nomeDoArquivo
     */
    public function setNomeDoArquivo($nomeDoArquivo)
    {
        $this->nomeDoArquivo = $nomeDoArquivo;
    }

    /**
     * Returns a SplFileObject
     *
     * @return \SplFileObject
     */
    public function getFileHandler()
    {
        return new \SplFileObject($this->nomeDoArquivo);
    }

    /**
     * @return Header header
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @param Header $header
     */
    public function setHeader(Header $header)
    {
        $header->setArquivo($this);
        $this->header = $header;
    }
}