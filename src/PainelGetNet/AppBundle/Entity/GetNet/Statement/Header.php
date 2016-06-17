<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 03/03/15
 * Time: 18:21
 */

namespace PainelGetNet\AppBundle\Entity\GetNet\Statement;

use PainelGetNet\AppBundle\Exception\GetNet\InvalidLineException;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Header
 *
 * @ORM\Entity(repositoryClass="PainelGetNet\AppBundle\Entity\GetNet\Statement\HeaderRepository")
 * @ORM\Table(name="getnet_statement_header")
 */
class Header {

    /**
     * @var
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="data_hora_de_criacao_do_arquivo",
     *      type="datetime"
     * )
     * @Assert\DateTime(message="Data de criação do arquivo inválida")
     */
    protected $dataHoraDeCriacaoDoArquivo;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="data_de_referencia_do_movimento",
     *      type="date"
     * )
     * @Assert\DateTime(message="Data de referência do movimento inválida")
     */
    protected $dataDeReferenciaDoMovimento;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="arquivo_e_versao",
     *      type="string",
     *      length=8
     * )
     * @Assert\EqualTo(
     *      value="CEADM100",
     *      message="O arquivo e versão devem ser CEADM100"
     * )
     */
    protected $arquivoEVersao;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="codigo_do_estabelecimento",
     *      type="string",
     *      length=15
     * )
     * @Assert\Length(
     *      min=0,
     *      max=15,
     *      minMessage="O código do estabelecimento deve ter mais que {{min}} caracteres",
     *      maxMessage="O código do estabelecimento deve ser maior que {{max}} caracteres"
     * )
     */
    protected $codigoDoEstabelecimento;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="cnpj",
     *      type="string",
     *      length=14
     * )
     */
    protected $cnpj;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="nome_do_adquirente",
     *      type="string",
     *      length=20
     * )
     */
    protected $nomeDoAdquirente;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="sequencia",
     *      type="integer"
     * )
     */
    protected $sequencia;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="codigo_do_adquirente",
     *      type="string",
     *      length=2
     * )
     */
    protected $codigoDoAdquirente;

    /**
     * @var Arquivo File
     *
     * @ORM\OneToOne(
     *      targetEntity="PainelGetNet\AppBundle\Entity\GetNet\Statement\Arquivo",
     *      inversedBy="header",
     *      cascade={"persist"}
     * )
     */
    protected $arquivo;

    /**
     * @var
     *
     * @ORM\OneToMany(
     *      targetEntity="PainelGetNet\AppBundle\Entity\GetNet\Statement\ResumoDeVenda",
     *      mappedBy="header",
     *      cascade={"persist"}
     * )
     */
    protected $resumoDeVendas;

    public function __construct(){
        $this->resumoDeVendas = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDataHoraDeCriacaoDoArquivo()
    {
        return $this->dataHoraDeCriacaoDoArquivo;
    }

    /**
     * @param mixed $dataHoraDeCriacaoDoArquivo
     */
    public function setDataHoraDeCriacaoDoArquivo(\DateTime $dataHoraDeCriacaoDoArquivo)
    {
        $this->dataHoraDeCriacaoDoArquivo = $dataHoraDeCriacaoDoArquivo;
    }

    /**
     * @return mixed
     */
    public function getDataDeReferenciaDoMovimento()
    {
        return $this->dataDeReferenciaDoMovimento;
    }

    /**
     * @param mixed $dataDeReferenciaDoMovimento
     */
    public function setDataDeReferenciaDoMovimento(\DateTime $dataDeReferenciaDoMovimento)
    {
        $this->dataDeReferenciaDoMovimento = $dataDeReferenciaDoMovimento;
    }

    /**
     * @return mixed
     */
    public function getArquivoEVersao()
    {
        return $this->arquivoEVersao;
    }

    /**
     * @param mixed $arquivoEVersao
     */
    public function setArquivoEVersao($arquivoEVersao)
    {
        $this->arquivoEVersao = $arquivoEVersao;
    }

    /**
     * @return mixed
     */
    public function getCodigoDoEstabelecimento()
    {
        return $this->codigoDoEstabelecimento;
    }

    /**
     * @param mixed $codigoDoEstabelecimento
     */
    public function setCodigoDoEstabelecimento($codigoDoEstabelecimento)
    {
        $this->codigoDoEstabelecimento = $codigoDoEstabelecimento;
    }

    /**
     * @return mixed
     */
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * @param mixed $cnpj
     */
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
    }

    /**
     * @return mixed
     */
    public function getNomeDoAdquirente()
    {
        return $this->nomeDoAdquirente;
    }

    /**
     * @param mixed $nomeDoAdquirente
     */
    public function setNomeDoAdquirente($nomeDoAdquirente)
    {
        $this->nomeDoAdquirente = $nomeDoAdquirente;
    }

    /**
     * @return mixed
     */
    public function getSequencia()
    {
        return $this->sequencia;
    }

    /**
     * @param mixed $sequencia
     */
    public function setSequencia($sequencia)
    {
        $this->sequencia = $sequencia;
    }

    /**
     * @return mixed
     */
    public function getCodigoDoAdquirente()
    {
        return $this->codigoDoAdquirente;
    }

    /**
     * @param mixed $codigoDoAdquirente
     */
    public function setCodigoDoAdquirente($codigoDoAdquirente)
    {
        $this->codigoDoAdquirente = $codigoDoAdquirente;
    }

    /**
     * @return mixed
     */
    public function getResumoDeVendas()
    {
        return $this->resumoDeVendas;
    }

    /**
     * @param mixed $saleSummary
     */
    public function addResumoDeVenda(ResumoDeVenda $resumoDeVenda)
    {
        $resumoDeVenda->setHeader($this);
        $this->resumoDeVendas[] = $resumoDeVenda;
    }

    /**
     * @return Arquivo
     */
    public function getArquivo()
    {
        return $this->arquivo;
    }

    /**
     * @param Arquivo $arquivo
     */
    public function setArquivo(Arquivo $arquivo)
    {
        $this->arquivo = $arquivo;
    }
}