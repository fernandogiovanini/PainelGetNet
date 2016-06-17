<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 03/03/15
 * Time: 18:26
 */

namespace PainelGetNet\AppBundle\Entity\GetNet\Statement;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Transacao
 *
 * @ORM\Entity()
 * @ORM\Table(name="getnet_statement_transacao")
 */
class Transacao {

    /**
     * @var
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="codigo_do_estabelecimento",
     *      type="string",
     *      length=15
     * )
     */
    private $codigoDoEstabelecimento;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="numero_do_resumo_de_venda",
     *      type="integer"
     * )
     */
    private $numeroDoResumoDeVenda;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="nsu_do_adquirente",
     *      type="integer",
     *      nullable=true
     * )
     */
    private $nsuDoAdquirente;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="data_hora_da_transacao",
     *      type="datetime"
     * )
     */
    private $dataHoraDaTransacao;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="numero_do_cartao",
     *      type="string",
     *      length=19,
     *      nullable=true
     * )
     */
    private $numeroDoCartao;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="valor_da_transacao",
     *      type="float"
     * )
     */
    private $valorDaTransacao;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="valor_do_saque",
     *      type="float"
     * )
     */
    private $valorDoSaque;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="valor_da_taxa_de_servico",
     *      type="float"
     * )
     */
    private $valorDaTaxaDeServico;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="numero_de_parcelas",
     *      type="integer"
     * )
     */
    private $numeroDeParcelas;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="numero_da_parcela_paga",
     *      type="integer"
     * )
     */
    private $numeroDaParcelaPaga;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="valor_da_parcela_paga",
     *      type="float"
     * )
     */
    private $valorDaParcelaPaga;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="data_do_pagamento",
     *      type="date"
     * )
     */
    private $dataDoPagamento;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="codigo_de_autorizacao",
     *      type="string",
     *      length=10
     * )
     */
    private $codigoDeAutorizacao;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="forma_de_captura",
     *      type="string",
     *      length=3
     * )
     */
    private $formaDeCaptura;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="status_da_transacao",
     *      type="string",
     *      length=1
     * )
     */
    private $statusDaTransacao;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="codigo_do_estabelecimento_centralizador_dos_pagamentos",
     *      type="string",
     *      length=15
     * )
     */
    private $codigoDoEstabelecimentoCentralizadorDosPagamentos;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="numero_do_terminal",
     *      type="string",
     *      length=8
     * )
     */
    private $numeroDoTerminal;

    /**
     * @var
     *
     * @ORM\ManyToOne(
     *      targetEntity="PainelGetNet\AppBundle\Entity\GetNet\Statement\ResumoDeVenda",
     *      inversedBy="transacoes"
     * )
     * @ORM\JoinColumn(
     *      name="resumo_de_venda_id",
     *      referencedColumnName="id"
     * )
     */
    private $resumoDeVenda;

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
    public function getNumeroDoResumoDeVenda()
    {
        return $this->numeroDoResumoDeVenda;
    }

    /**
     * @param mixed $numeroDoResumoDeVenda
     */
    public function setNumeroDoResumoDeVenda($numeroDoResumoDeVenda)
    {
        $this->numeroDoResumoDeVenda = $numeroDoResumoDeVenda;
    }

    /**
     * @return mixed
     */
    public function getNsuDoAdquirente()
    {
        return $this->nsuDoAdquirente;
    }

    /**
     * @param mixed $nsuDoAdquirente
     */
    public function setNsuDoAdquirente($nsuDoAdquirente)
    {
        $this->nsuDoAdquirente = $nsuDoAdquirente;
    }

    /**
     * @return mixed
     */
    public function getDataHoraDaTransacao()
    {
        return $this->dataHoraDaTransacao;
    }

    /**
     * @param mixed $dataHoraDaTransacao
     */
    public function setDataHoraDaTransacao(\DateTime $dataHoraDaTransacao)
    {
        $this->dataHoraDaTransacao = $dataHoraDaTransacao;
    }

    /**
     * @return mixed
     */
    public function getNumeroDoCartao()
    {
        return $this->numeroDoCartao;
    }

    /**
     * @param mixed $numeroDoCartao
     */
    public function setNumeroDoCartao($numeroDoCartao)
    {
        $this->numeroDoCartao = $numeroDoCartao;
    }

    /**
     * @return mixed
     */
    public function getValorDaTransacao()
    {
        return $this->valorDaTransacao;
    }

    /**
     * @param mixed $valorDaTransacao
     */
    public function setValorDaTransacao($valorDaTransacao)
    {
        $this->valorDaTransacao = $valorDaTransacao;
    }

    /**
     * @return mixed
     */
    public function getValorDoSaque()
    {
        return $this->valorDoSaque;
    }

    /**
     * @param mixed $valorDoSaque
     */
    public function setValorDoSaque($valorDoSaque)
    {
        $this->valorDoSaque = $valorDoSaque;
    }

    /**
     * @return mixed
     */
    public function getValorDaTaxaDeServico()
    {
        return $this->valorDaTaxaDeServico;
    }

    /**
     * @param mixed $valorDaTaxaDeServico
     */
    public function setValorDaTaxaDeServico($valorDaTaxaDeServico)
    {
        $this->valorDaTaxaDeServico = $valorDaTaxaDeServico;
    }

    /**
     * @return mixed
     */
    public function getNumeroDeParcelas()
    {
        return $this->numeroDeParcelas;
    }

    /**
     * @param mixed $numeroDeParcelas
     */
    public function setNumeroDeParcelas($numeroDeParcelas)
    {
        $this->numeroDeParcelas = $numeroDeParcelas;
    }

    /**
     * @return mixed
     */
    public function getNumeroDaParcelaPaga()
    {
        return $this->numeroDaParcelaPaga;
    }

    /**
     * @param mixed $numeroDaParcelaPaga
     */
    public function setNumeroDaParcelaPaga($numeroDaParcelaPaga)
    {
        $this->numeroDaParcelaPaga = $numeroDaParcelaPaga;
    }

    /**
     * @return mixed
     */
    public function getValorDaParcelaPaga()
    {
        return $this->valorDaParcelaPaga;
    }

    /**
     * @param mixed $valorDaParcelaPaga
     */
    public function setValorDaParcelaPaga($valorDaParcelaPaga)
    {
        $this->valorDaParcelaPaga = $valorDaParcelaPaga;
    }

    /**
     * @return mixed
     */
    public function getDataDoPagamento()
    {
        return $this->dataDoPagamento;
    }

    /**
     * @param mixed $dataDoPagamento
     */
    public function setDataDoPagamento(\DateTime $dataDoPagamento)
    {
        $this->dataDoPagamento = $dataDoPagamento;
    }

    /**
     * @return mixed
     */
    public function getCodigoDeAutorizacao()
    {
        return $this->codigoDeAutorizacao;
    }

    /**
     * @param mixed $codigoDeAutorizacao
     */
    public function setCodigoDeAutorizacao($codigoDeAutorizacao)
    {
        $this->codigoDeAutorizacao = $codigoDeAutorizacao;
    }

    /**
     * @return mixed
     */
    public function getFormaDeCaptura()
    {
        return $this->formaDeCaptura;
    }

    /**
     * @param mixed $formaDeCaptura
     */
    public function setFormaDeCaptura($formaDeCaptura)
    {
        if(!in_array($formaDeCaptura, FormaDeCaptura::getValues()) && !empty($formaDeCaptura)){
            throw new \InvalidArgumentException("Forma de captura '$formaDeCaptura' inválida");
        }
        $this->formaDeCaptura = $formaDeCaptura;
    }

    /**
     * @return mixed
     */
    public function getStatusDaTransacao()
    {
        return $this->statusDaTransacao;
    }

    /**
     * @param mixed $statusDaTransacao
     */
    public function setStatusDaTransacao($statusDaTransacao)
    {
        if(!in_array($statusDaTransacao, StatusDaTransacao::getValues())){
            throw new \InvalidArgumentException("Status da transação $statusDaTransacao inválido");
        }
        $this->statusDaTransacao = $statusDaTransacao;
    }

    /**
     * @return mixed
     */
    public function getCodigoDoEstabelecimentoCentralizadorDosPagamentos()
    {
        return $this->codigoDoEstabelecimentoCentralizadorDosPagamentos;
    }

    /**
     * @param mixed $codigoDoEstabelecimentoCentralizadorDosPagamentos
     */
    public function setCodigoDoEstabelecimentoCentralizadorDosPagamentos($codigoDoEstabelecimentoCentralizadorDosPagamentos)
    {
        $this->codigoDoEstabelecimentoCentralizadorDosPagamentos = $codigoDoEstabelecimentoCentralizadorDosPagamentos;
    }

    /**
     * @return mixed
     */
    public function getNumeroDoTerminal()
    {
        return $this->numeroDoTerminal;
    }

    /**
     * @param mixed $numeroDoTerminal
     */
    public function setNumeroDoTerminal($numeroDoTerminal)
    {
        $this->numeroDoTerminal = $numeroDoTerminal;
    }

    /**
     * @return mixed
     */
    public function getResumoDeVenda()
    {
        return $this->resumoDeVenda;
    }

    /**
     * @param mixed $resumoDeVenda
     */
    public function setResumoDeVenda($resumoDeVenda)
    {
        $this->resumoDeVenda = $resumoDeVenda;
    }


}