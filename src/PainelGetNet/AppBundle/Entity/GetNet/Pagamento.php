<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 09/03/15
 * Time: 10:34
 */

namespace PainelGetNet\AppBundle\Entity\GetNet;

use PainelGetNet\AppBundle\Entity\GetNet\Statement\ResumoDeVenda;
use PainelGetNet\AppBundle\Entity\GetNet\Statement\TipoDePagamento;
use PainelGetNet\AppBundle\Exception\GetNet\InvalidResumoDeVendaException;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class Pagamento
 *
 * @ORM\Table(
 *      name="getnet_pagamento",
 *      uniqueConstraints={
 *           @UniqueConstraint(
 *              name="rv_parcela_idx",
 *              columns={
                    "numero_do_rv",
 *                  "parcela"
 *              }
 *          )
 *      }
 * )
 * @ORM\Entity(repositoryClass="PainelGetNet\AppBundle\Entity\GetNet\PagamentoRepository")
 */
class Pagamento {

    /**
     * @var
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Número do Resumo de Vendas
     *
     * @var integer
     *
     * @ORM\Column(
     *      name="numero_do_rv",
     *      type="integer"
     * )
     */
    private $numeroDoRv;

    /**
     * Produto
     *
     * Produtos são as formas de pagamento, como cartão de crédito Visa
     *
     * @var string
     *
     * @ORM\Column(
     *      name="produto",
     *      type="string",
     *      length=2
     * )
     */
    private $produto;

    /**
     * @var integer
     *
     * @ORM\Column(
     *      name="parcela",
     *      type="integer"
     * )
     */
    private $parcela;

    /**
     * @var integer
     *
     * @ORM\Column(
     *      name="total_de_parcelas",
     *      type="integer"
     * )
     */
    private $totalDeParcelas;

    /**
     * @var DateTime
     *
     * @ORM\Column(
     *      name="data_da_venda",
     *      type="date"
     * )
     */
    private $dataDaVenda;

    /**
     * @var DateTime
     *
     * @ORM\Column(
     *      name="data_programada_do_pagamento",
     *      type="date"
     * )
     */
    private $dataProgramadaDoPagamento;

    /**
     * @var DateTime
     *
     * @ORM\Column(
     *      name="data_do_pagamento",
     *      type="date",
     *      nullable=true
     * )
     */
    private $dataDoPagamento;

    /**
     * @var DateTime
     *
     * @ORM\Column(
     *      name="data_do_ajuste",
     *      type="date",
     *      nullable=true
     * )
     */
    private $dataDoAjuste;

    /**
     * @var float
     *
     * @ORM\Column(
     *      name="valor_para_o_cliente",
     *      type="float"
     * )
     */
    private $valorParaOCliente;

    /**
     * @var float
     *
     * @ORM\Column(
     *      name="valor_a_receber",
     *      type="float"
     * )
     */
    private $valorAReceber;

    /**
     * @var float
     *
     * @ORM\Column(
     *      name="valor_pago",
     *      type="float",
     *      nullable=true
     * )
     */
    private $valorPago;

    /**
     * @var float
     *
     * @ORM\Column(
     *      name="valor_ajustado",
     *      type="float",
     *      nullable=true
     * )
     */
    private $valorAjustado;

    /**
     * @var DateTime
     *
     * @ORM\Column(
     *      name="status_do_pagamento",
     *      type="string",
     *      length=15
     * )
     */
    private $statusDoPagamento;

    /**
     * @var string
     *
     * @ORM\Column(
     *      name="tipo_de_movimento",
     *      type="string",
     *      length=2,
     *      nullable=true
     * )
     */
    private $tipoDeMovimento;

    /**
     * @var float
     *
     * @ORM\Column(
     *      name="valor_da_taxa_de_servico",
     *      type="float",
     *      nullable=true
     * )
     */
    private $valorDeTaxaDeServico;

    /**
     * @var float
     *
     * @ORM\Column(
     *      name="valor_da_taxa_de_desconto",
     *      type="float",
     *      nullable=true
     * )
     */
    private $valorDeTaxaDeDesconto;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getNumeroDoRv()
    {
        return $this->numeroDoRv;
    }

    /**
     * @param int $numeroDoRv
     */
    public function setNumeroDoRv($numeroDoRv)
    {
        $this->numeroDoRv = $numeroDoRv;
    }

    /**
     * @return string
     */
    public function getProduto()
    {
        return $this->produto;
    }

    /**
     * @param string $produto
     */
    public function setProduto($produto)
    {
        $this->produto = $produto;
    }

    /**
     * @return int
     */
    public function getParcela()
    {
        return $this->parcela;
    }

    /**
     * @param int $parcela
     */
    public function setParcela($parcela)
    {
        $this->parcela = $parcela;
    }

    /**
     * @return int
     */
    public function getTotalDeParcelas()
    {
        return $this->totalDeParcelas;
    }

    /**
     * @param int $totalDeParcelas
     */
    public function setTotalDeParcelas($totalDeParcelas)
    {
        $this->totalDeParcelas = $totalDeParcelas;
    }

    /**
     * @return DateTime
     */
    public function getDataDaVenda()
    {
        return $this->dataDaVenda;
    }

    /**
     * @param DateTime $dataDaVenda
     */
    public function setDataDaVenda(\DateTime $dataDaVenda)
    {
        $this->dataDaVenda = $dataDaVenda;
    }

    /**
     * @return DateTime
     */
    public function getDataProgramadaDoPagamento()
    {
        return $this->dataProgramadaDoPagamento;
    }

    /**
     * @param DateTime $dataProgramadaDoPagamento
     */
    public function setDataProgramadaDoPagamento(\DateTime $dataProgramadaDoPagamento)
    {
        $this->dataProgramadaDoPagamento = $dataProgramadaDoPagamento;
    }

    /**
     * @return DateTime
     */
    public function getDataDoPagamento()
    {
        return $this->dataDoPagamento;
    }

    /**
     * @param DateTime $dataDoPagamento
     */
    public function setDataDoPagamento(\DateTime $dataDoPagamento)
    {
        $this->dataDoPagamento = $dataDoPagamento;
    }

    /**
     * @return DateTime
     */
    public function getDataDoAjuste()
    {
        return $this->dataDoAjuste;
    }

    /**
     * @param DateTime $dataDoAjuste
     */
    public function setDataDoAjuste(\DateTime $dataDoAjuste)
    {
        $this->dataDoAjuste = $dataDoAjuste;
    }

    /**
     * @return float
     */
    public function getValorParaOCliente()
    {
        return $this->valorParaOCliente;
    }

    /**
     * @param float $valorParaOCliente
     */
    public function setValorParaOCliente($valorParaOCliente)
    {
        $this->valorParaOCliente = $valorParaOCliente;
    }

    /**
     * @return float
     */
    public function getValorAReceber()
    {
        return $this->valorAReceber;
    }

    /**
     * @param float $valorAReceber
     */
    public function setValorAReceber($valorAReceber)
    {
        $this->valorAReceber = $valorAReceber;
    }

    /**
     * @return float
     */
    public function getValorPago()
    {
        return $this->valorPago;
    }

    /**
     * @param float $valorPago
     */
    public function setValorPago($valorPago)
    {
        $this->valorPago = $valorPago;
    }

    /**
     * @return float
     */
    public function getValorAjustado()
    {
        return $this->valorAjustado;
    }

    /**
     * @param float $valorAjustado
     */
    public function setValorAjustado($valorAjustado)
    {
        $this->valorAjustado = $valorAjustado;
    }

    /**
     * @return mixed
     */
    public function getStatusDoPagamento()
    {
        return $this->statusDoPagamento;
    }

    /**
     * @param mixed $statusDoPagamento
     */
    public function setStatusDoPagamento($statusDoPagamento)
    {
        $this->statusDoPagamento = $statusDoPagamento;
    }

    /**
     * @return string
     */
    public function getTipoDeMovimento()
    {
        return $this->tipoDeMovimento;
    }

    /**
     * @param string $tipoDeMovimento
     */
    public function setTipoDeMovimento($tipoDeMovimento)
    {
        $this->tipoDeMovimento = $tipoDeMovimento;
    }

    /**
     * @return float
     */
    public function getValorDeTaxaDeServico()
    {
        return $this->valorDeTaxaDeServico;
    }

    /**
     * @param float $valorDeTaxaDeServico
     */
    public function setValorDeTaxaDeServico($valorDeTaxaDeServico)
    {
        $this->valorDeTaxaDeServico = $valorDeTaxaDeServico;
    }

    /**
     * @return float
     */
    public function getValorDeTaxaDeDesconto()
    {
        return $this->valorDeTaxaDeDesconto;
    }

    /**
     * @param float $valorDeTaxaDeDesconto
     */
    public function setValorDeTaxaDeDesconto($valorDeTaxaDeDesconto)
    {
        $this->valorDeTaxaDeDesconto = $valorDeTaxaDeDesconto;
    }

    public function valorCustoTotal()
    {
        return $this->getValorDeTaxaDeDesconto() + $this->getValorDeTaxaDeServico();
    }

    public static function createFromResumoDeVenda(ResumoDeVenda $resumoDeVenda){
        if($resumoDeVenda->getTipoDePagamento() == TipoDePagamento::PAGAMENTO_FUTURO){
            return self::createFromFuturePayment($resumoDeVenda);
        }
        return self::createFromPaymentConfirmation($resumoDeVenda);
    }

    public static function createFromFuturePayment(ResumoDeVenda $resumoDeVenda)
    {
        if(!$resumoDeVenda->isPagamentoFuturo()){
            throw new \InvalidArgumentException('O método createFromPF aceita registros de pagamento futuro');
        }
        $pagamento = new Pagamento();
        $pagamento->setDataDaVenda($resumoDeVenda->getDataDoResumoDeVenda());
        $pagamento->setDataProgramadaDoPagamento($resumoDeVenda->getDataDoPagamentoDoResumoDeVendas());
        $pagamento->setNumeroDoRv($resumoDeVenda->getNumeroDoResumoDeVendas());
        $pagamento->setProduto($resumoDeVenda->getProduto());
        $pagamento->setParcela($resumoDeVenda->getNumeroDaParcelaDoResumoDeVenda());
        $pagamento->setTotalDeParcelas($resumoDeVenda->getQuantidadeDeParcelasDoResumoDeVenda());
        $pagamento->setValorAReceber($resumoDeVenda->getValorLiquido());
        $pagamento->setValorParaOCliente($resumoDeVenda->getValorBruto());
        $pagamento->setValorDeTaxaDeServico($resumoDeVenda->getValorDaTaxaDeServico());
        $pagamento->setValorDeTaxaDeDesconto($resumoDeVenda->getValorDaTaxaDeDesconto());
        $pagamento->setStatusDoPagamento(StatusDoPagamento::A_RECEBER);
        return $pagamento;
    }

    public static function createFromPaymentConfirmation(ResumoDeVenda $resumoDeVenda)
    {
        if(!$resumoDeVenda->isConfirmacaoDePagamento()){
            throw new \InvalidArgumentException('O método createFromPaymentConfirmation aceita registros de confirmação de pagamento');
        }
        $pagamento = new Pagamento();
        $pagamento->setDataDaVenda($resumoDeVenda->getDataDoResumoDeVenda());
        $pagamento->setDataProgramadaDoPagamento($resumoDeVenda->getDataDoPagamentoDoResumoDeVendas());
        $pagamento->setDataDoPagamento($resumoDeVenda->getDataDoPagamentoDoResumoDeVendas());
        $pagamento->setNumeroDoRv($resumoDeVenda->getNumeroDoResumoDeVendas());
        $pagamento->setProduto($resumoDeVenda->getProduto());
        $pagamento->setParcela($resumoDeVenda->getNumeroDaParcelaDoResumoDeVenda());
        $pagamento->setTotalDeParcelas($resumoDeVenda->getQuantidadeDeParcelasDoResumoDeVenda());
        $pagamento->setValorParaOCliente($resumoDeVenda->getValorBruto());
        $pagamento->setValorAReceber($resumoDeVenda->getValorLiquido());
        $pagamento->setValorPago($resumoDeVenda->getValorLiquido());
        $pagamento->setTipoDeMovimento($resumoDeVenda->getTipoDePagamento());
        $pagamento->setValorDeTaxaDeServico($resumoDeVenda->getValorDaTaxaDeServico());
        $pagamento->setValorDeTaxaDeDesconto($resumoDeVenda->getValorDaTaxaDeDesconto());
        $pagamento->setStatusDoPagamento(StatusDoPagamento::PAGO);
        return $pagamento;
    }

    public function confirmPayment(Pagamento $pagamento){
        $this->setValorPago($pagamento->getValorPago());
        $this->setDataDoPagamento($pagamento->getDataDoPagamento());
        $this->setStatusDoPagamento($pagamento->getStatusDoPagamento());
        $this->setTipoDeMovimento($pagamento->getTipoDeMovimento());
        $this->setValorDeTaxaDeServico($pagamento->getValorDeTaxaDeServico());
        $this->setValorDeTaxaDeDesconto($pagamento->getValorDeTaxaDeDesconto());
    }
}