<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 03/03/15
 * Time: 18:25
 */

namespace PainelGetNet\AppBundle\Entity\GetNet\Statement;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Ajuste
 *
 * @ORM\Entity()
 * @ORM\Table(name="getnet_statement_ajuste")
 * @ORM\HasLifecycleCallbacks()
 */
class Ajuste {

    /**
     * @var
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
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
     *      name="numero_do_resumo_de_venda_ajustado",
     *      type="integer"
     * )
     */
    private $numeroDoResumoDeVendaAjustado;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="data_do_resumo_de_venda",
     *      type="date"
     * )
     */
    private $dataDoResumoDeVenda;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="data_do_pagamento_do_resumo_de_venda",
     *      type="date"
     * )
     */
    private $dataDoPagamentoDoResumoDeVenda;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="identificador_do_ajuste",
     *      type="string",
     *      length=20
     * )
     */
    private $identificadorDoAjuste;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="sinal_do_valor_do_ajuste",
     *      type="string",
     *      length=1
     * )
     */
    private $sinalDoValorDoAjuste;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="valor_do_ajuste",
     *      type="float"
     * )
     */
    private $valorDoAjuste;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="motivo_do_ajuste",
     *      type="integer"
     * )
     */
    private $motivoDoAjuste;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="valor_do_ajuste_com_sinal",
     *      type="float"
     * )
     */
    private $valorDoAjusteComSinal;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="data_da_carta",
     *      type="date"
     * )
     */
    private $dataDaCarta;

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
     *      name="numero_do_registro_de_venda_original",
     *      type="integer",
     *      nullable=true
     * )
     */
    private $numeroDoRegistroDeVendaOriginal;

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
     *      name="data_da_transacao_original",
     *      type="date",
     *      nullable=true
     * )
     */
    private $dataDaTransacaoOriginal;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="tipo_de_pagamento",
     *      type="string",
     *      length=2
     * )
     */
    private $tipoDePagamento;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="numero_do_terminal",
     *      type="string",
     *      length=9
     * )
     */
    private $numeroDoTerminal;

    /**
     * @var
     *
     * @ORM\Column(
     *      name="data_do_pagamento",
     *      type="date",
     *      nullable=true
     * )
     */
    private $dataDoPagamento;

    /**
     * @var
     *
     * @ORM\ManyToOne(
     *      targetEntity="PainelGetNet\AppBundle\Entity\GetNet\Statement\ResumoDeVenda",
     *      inversedBy="ajustes"
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
    public function getNumeroDoResumoDeVendaAjustado()
    {
        return $this->numeroDoResumoDeVendaAjustado;
    }

    /**
     * @param mixed $numeroDoResumoDeVendaAjustado
     */
    public function setNumeroDoResumoDeVendaAjustado($numeroDoResumoDeVendaAjustado)
    {
        $this->numeroDoResumoDeVendaAjustado = $numeroDoResumoDeVendaAjustado;
    }

    /**
     * @return mixed
     */
    public function getDataDoResumoDeVenda()
    {
        return $this->dataDoResumoDeVenda;
    }

    /**
     * @param mixed $dataDoResumoDeVenda
     */
    public function setDataDoResumoDeVenda(\DateTime $dataDoResumoDeVenda)
    {
        $this->dataDoResumoDeVenda = $dataDoResumoDeVenda;
    }

    /**
     * @return mixed
     */
    public function getDataDoPagamentoDoResumoDeVenda()
    {
        return $this->dataDoPagamentoDoResumoDeVenda;
    }

    /**
     * @param mixed $dataDoPagamentoDoResumoDeVenda
     */
    public function setDataDoPagamentoDoResumoDeVenda(\DateTime $dataDoPagamentoDoResumoDeVenda)
    {
        $this->dataDoPagamentoDoResumoDeVenda = $dataDoPagamentoDoResumoDeVenda;
    }

    /**
     * @return mixed
     */
    public function getIdentificadorDoAjuste()
    {
        return $this->identificadorDoAjuste;
    }

    /**
     * @param mixed $identificadorDoAjuste
     */
    public function setIdentificadorDoAjuste($identificadorDoAjuste)
    {
        $this->identificadorDoAjuste = $identificadorDoAjuste;
    }

    /**
     * @return mixed
     */
    public function getSinalDoValorDoAjuste()
    {
        return $this->sinalDoValorDoAjuste;
    }

    /**
     * @param mixed $sinalDoValorDoAjuste
     */
    public function setSinalDoValorDoAjuste($sinalDoValorDoAjuste)
    {
        if(!in_array($sinalDoValorDoAjuste, ['-','+'])){
            throw new \InvalidArgumentException("Sinal do valor do ajuste inválido");
        }
        $this->sinalDoValorDoAjuste = $sinalDoValorDoAjuste;
    }

    /**
     * @return mixed
     */
    public function getValorDoAjuste()
    {
        return $this->valorDoAjuste;
    }

    /**
     * @param mixed $valorDoAjuste
     */
    public function setValorDoAjuste($valorDoAjuste)
    {
        $this->valorDoAjuste = $valorDoAjuste;
    }

    /**
     * @return mixed
     */
    public function getMotivoDoAjuste()
    {
        return $this->motivoDoAjuste;
    }

    /**
     * @param mixed $motivoDoAjuste
     */
    public function setMotivoDoAjuste($motivoDoAjuste)
    {
        if(!in_array($motivoDoAjuste, MotivoDoAjuste::getValues())){
            throw new \InvalidArgumentException("Motivo do ajuste $formaDeCaptura inválido");
        }
        $this->motivoDoAjuste = $motivoDoAjuste;
    }

    /**
     * @return mixed
     */
    public function getDataDaCarta()
    {
        return $this->dataDaCarta;
    }

    /**
     * @param mixed $dataDaCarta
     */
    public function setDataDaCarta(\DateTime $dataDaCarta)
    {
        $this->dataDaCarta = $dataDaCarta;
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
    public function getNumeroDoRegistroDeVendaOriginal()
    {
        return $this->numeroDoRegistroDeVendaOriginal;
    }

    /**
     * @param mixed $numeroDoRegistroDeVendaOriginal
     */
    public function setNumeroDoRegistroDeVendaOriginal($numeroDoRegistroDeVendaOriginal)
    {
        $this->numeroDoRegistroDeVendaOriginal = $numeroDoRegistroDeVendaOriginal;
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
    public function getDataDaTransacaoOriginal()
    {
        return $this->dataDaTransacaoOriginal;
    }

    /**
     * @param mixed $dataDaTransacaoOriginal
     */
    public function setDataDaTransacaoOriginal(\DateTime $dataDaTransacaoOriginal = null)
    {
        $this->dataDaTransacaoOriginal = $dataDaTransacaoOriginal;
    }

    /**
     * @return mixed
     */
    public function getTipoDePagamento()
    {
        return $this->tipoDePagamento;
    }

    /**
     * @param mixed $tipoDePagamento
     */
    public function setTipoDePagamento($tipoDePagamento)
    {
        if(!in_array($tipoDePagamento, TipoDePagamento::getValues()) && !is_null($tipoDePagamento)){
            throw new \InvalidArgumentException("Tipo de pagamento $tipoDePagamento inválido");
        }
        $this->tipoDePagamento = $tipoDePagamento;
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
    public function getDataDoPagamento()
    {
        return $this->dataDoPagamento;
    }

    /**
     * @param mixed $dataDoPagamento
     */
    public function setDataDoPagamento(\DateTime $dataDoPagamento = null)
    {
        $this->dataDoPagamento = $dataDoPagamento;
    }

    /**
     * @return ResumoDeVenda
     */
    public function getResumoDeVenda()
    {
        return $this->resumoDeVenda;
    }

    /**
     * @param ResumoDeVenda $resumoDeVenda
     */
    public function setResumoDeVenda(ResumoDeVenda $resumoDeVenda)
    {
        $this->resumoDeVenda = $resumoDeVenda;
    }

    /**
     * @return mixed
     */
    public function getValorDoAjusteComSinal()
    {
        return $this->valorDoAjusteComSinal;
    }

    /**
     * @param mixed $valorDoAjusteComSinal
     *
     * @ORM\PrePersist()
     */
    public function setValorDoAjusteComSinal()
    {
        $this->valorDoAjusteComSinal = ($this->getSinalDoValorDoAjuste() . 1) * (float) $this->getValorDoAjuste();
    }
}