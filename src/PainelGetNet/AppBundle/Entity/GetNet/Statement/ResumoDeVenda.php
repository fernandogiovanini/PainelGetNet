<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 03/03/15
 * Time: 18:25
 */

namespace PainelGetNet\AppBundle\Entity\GetNet\Statement;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class ResumoDeVenda
 *
 * @ORM\Entity(repositoryClass="PainelGetNet\AppBundle\Entity\GetNet\Statement\ResumoDeVendaRepository")
 * @ORM\Table(name="getnet_statement_resumo_de_venda")
 */
class ResumoDeVenda
{

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Código de origem ou maquineta
     *
     * @var string
     *
     * @ORM\Column(
     *      name="codigo_do_estabelecimento",
     *      type="string",
     *      length=15
     * )
     */
    private $codigoDoEstabelecimento;

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
     * Forma de captura da transação
     *
     * Pode receber os valores TEF, POS, MAN(UAL), INT(ernet);
     * Caso o Resumo de Venda possua transações com várias formas
     * de captura, o campo está em branco e as formas de captura
     * estarão no campo Transacao::formaDeCaptura.
     * (Observação: Para os domínios RA e PR, esse campo estará
     * em branco)
     *
     * @var string
     *
     * @ORM\Column(
     *      name="forma_de_captura",
     *      type="string",
     *      length=3
     * )
     */
    private $formaDeCaptura;

    /**
     * Número do Resumo de Vendas
     *
     * @var integer
     *
     * @ORM\Column(
     *      name="numero_do_resumo_de_vendas",
     *      type="integer"
     * )
     */
    private $numeroDoResumoDeVendas;

    /**
     * Data do processamento
     *
     * @var DateTime
     *
     * @ORM\Column(
     *      name="data_do_resumo_de_venda",
     *      type="date"
     * )
     */
    private $dataDoResumoDeVenda;

    /**
     * Data do pagamento do RV
     *
     * @var DateTime
     *
     * @ORM\Column(
     *      name="data_do_pagamento_do_resumo_de_vendas",
     *      type="date"
     * )
     */
    private $dataDoPagamentoDoResumoDeVendas;

    /**
     * Código da Instituição Financeira
     *
     * @var integer
     *
     * ORM\Embedded(class = "ContaCorrente", columnPrefix = "conta_corrente_")
     * @ORM\Column(
     *      name="conta_corrente_banco",
     *      type="integer"
     * )
     */
    private $contaCorrenteBanco;

    /**
     * Número da Agência
     *
     * @var integer
     *
     * @ORM\Column(
     *      name="conta_corrente_agencia",
     *      type="integer"
     * )
     */
    private $contaCorrenteAgencia;

    /**
     * Número da Conta Corrente
     *
     * @var integer
     *
     * @ORM\Column(
     *      name="conta_corrente_numero",
     *      type="integer"
     * )
     */
    private $contaCorrenteNumero;

    /**
     * Quantidade de transações com status igual a ‘Aprovada’
     *
     * Para os domínios RA e PR, esse campo será preenchido
     * com zeros
     *
     * @var integer
     *
     * @ORM\Column(
     *      name="numero_dos_comprovantes_de_venda_aceitos",
     *      type="integer"
     * )
     */
    private $numeroDosComprovantesDeVendaAceitos;

    /**
     * Quantidade de transações com status diferente de ‘Aprovada’
     *
     * Para os domínios RA e PR, esse campo será preenchido
     * com zeros
     *
     * @var integer
     *
     * @ORM\Column(
     *      name="numero_dos_comprovantes_de_venda_rejeitados",
     *      type="integer"
     * )
     */
    private $numeroDosComprovantesDeVendaRejeitados;

    /**
     * Valor Bruto do RV
     *
     * Para os domínios RA e PR, constará o valor bruto
     * da antecipação rejeitada
     *
     * @var float
     *
     * @ORM\Column(
     *      name="valor_bruto",
     *      type="float"
     * )
     */
    private $valorBruto;

    /**
     * Valor Líquido
     *
     * É calculado como: $valorBruto - $valorDaTaxaDeDesconto
     *
     * Para os domínios RA e PR, constará o valor líquido da
     * antecipação rejeitada
     *
     * @var float
     *
     * @ORM\Column(
     *      name="valor_liquido",
     *      type="float"
     * )
     */
    private $valorLiquido;

    /**
     * Valor de taxa de Serviço
     *
     * Nem sempre é aplicável
     *
     * Para os domínios RA e PR, esse campo será preenchido
     * com zero
     *
     * @var float
     *
     * @ORM\Column(
     *      name="valor_da_taxa_de_servico",
     *      type="float"
     * )
     */
    private $valorDaTaxaDeServico;

    /**
     * Valor da Taxa de Desconto
     *
     * Para os domínios RA e PR, esse campo será preenchido
     * com zeros
     *
     * @var float
     *
     * @ORM\Column(
     *      name="valor_da_taxa_de_desconto",
     *      type="float"
     * )
     */
    private $valorDaTaxaDeDesconto;

    /**
     * Valor Total de transações rejeitadas
     *
     * Para os domínios RA e PR, esse campo será preenchido
     * com zeros
     *
     * @var float
     *
     * @ORM\Column(
     *      name="valor_rejeitado",
     *      type="float"
     * )
     */
    private $valorRejeitado;

    /**
     * Valor que será pago
     *
     * Para os domínios RA e PR, esse campo será preenchido
     * com zeros
     *
     * @var float
     *
     * @ORM\Column(
     *      name="valor_de_credito",
     *      type="float"
     * )
     */
    private $valorDeCredito;

    /**
     * Valor de encargos
     *
     * Ex: despesas com antecipação
     *
     * Para os domínios RA e PR, esse campo será preenchido
     * com zeros
     *
     * @var float
     *
     * @ORM\Column(
     *      name="valor_encargos",
     *      type="float"
     * )
     */
    private $valorEncargos;

    /**
     * Tipo de pagamento
     *
     * Pode receber valores como:
     *
     * - PF Pagamento Futuro (previsão)
     * - PG Pagamento Normal
     * - AC Antecipação de Crédito
     * - RA Rejeição de Antecipação
     * - PR Pagamento da Antecipação Rejeitada
     *
     * Os valores estão contidos em TipoDePagamento
     *
     * @var string
     *
     * @ORM\Column(
     *      name="tipo_de_pagamento",
     *      type="string",
     *      length=2,
     *      nullable=true
     * )
     */
    private $tipoDePagamento;

    /**
     * Número da parcela do RV
     *
     * Para os domínios RA e PR, esse campo será preenchido
     * com zeros
     *
     * @var integer
     *
     * @ORM\Column(
     *      name="numero_da_parcela_do_resumo_de_venda",
     *      type="integer"
     * )
     */
    private $numeroDaParcelaDoResumoDeVenda;

    /**
     * Quantidade de parcelas do RV
     *
     * Para os domínios RA e PR, esse campo será preenchido
     * com zeros
     *
     * @var integer
     *
     * @ORM\Column(
     *      name="quantidade_de_parcelas_do_resumo_de_venda",
     *      type="integer"
     * )
     */
    private $quantidadeDeParcelasDoResumoDeVenda;

    /**
     * Código do centralizador de pagamento ou da origem
     *
     * @var string
     *
     * @ORM\Column(
     *      name="codigo_do_estabelecimento_centralizador_dos_pagamentos",
     *      type="string",
     *      length=15
     * )
     */
    private $codigoDoEstabelecimentoCentralizadorDosPagamentos;

    /**
     * Header do arquivo
     *
     * @var Header
     *
     * @ORM\ManyToOne(
     *      targetEntity="PainelGetNet\AppBundle\Entity\GetNet\Statement\Header",
     *      inversedBy="resumoDeVendas",
     *      cascade={"persist"}
     * )
     */
    private $header;

    /**
     * Transações
     *
     * Transações relacionadas ao Resumo de Venda
     *
     * @var Transacao
     *
     * @ORM\OneToMany(
     *      targetEntity="PainelGetNet\AppBundle\Entity\GetNet\Statement\Transacao",
     *      mappedBy="resumoDeVenda",
     *      cascade={"persist"}
     * )
     */
    private $transacoes;

    /**
     * Ajustes
     *
     * Ajustes no Resumo de Venda
     *
     * @var Ajuste
     *
     * @ORM\OneToMany(
     *      targetEntity="PainelGetNet\AppBundle\Entity\GetNet\Statement\Ajuste",
     *      mappedBy="resumoDeVenda",
     *      cascade={"persist"}
     * )
     */
    private $ajustes;

    private $valorDaVenda;

    private $valorTotalLíquido;

    public function __construct()
    {
        $this->transacoes = new ArrayCollection();
        $this->ajustes = new ArrayCollection();
    }

    /**
     * @return integer
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
     * @return mixed
     */
    public function getProduto()
    {
        return $this->produto;
    }

    /**
     * @return mixed
     */
    public function getFormaDeCaptura()
    {
        return $this->formaDeCaptura;
    }

    /**
     * @return mixed
     */
    public function getNumeroDoResumoDeVendas()
    {
        return $this->numeroDoResumoDeVendas;
    }

    /**
     * @return mixed
     */
    public function getDataDoResumoDeVenda()
    {
        return $this->dataDoResumoDeVenda;
    }

    /**
     * @return mixed
     */
    public function getDataDoPagamentoDoResumoDeVendas()
    {
        return $this->dataDoPagamentoDoResumoDeVendas;
    }

    /**
     * @return mixed
     */
    public function getContaCorrente()
    {
        return $this->contaCorrente;
    }

    /**
     * @return mixed
     */
    public function getNumeroDosComprovantesDeVendaAceitos()
    {
        return $this->numeroDosComprovantesDeVendaAceitos;
    }

    /**
     * @return mixed
     */
    public function getNumeroDosComprovantesDeVendaRejeitados()
    {
        return $this->numeroDosComprovantesDeVendaRejeitados;
    }

    /**
     * @return mixed
     */
    public function getValorBruto()
    {
        return $this->valorBruto;
    }

    /**
     * @return mixed
     */
    public function getValorLiquido()
    {
        return $this->valorLiquido;
    }

    /**
     * @return mixed
     */
    public function getValorDaTaxaDeServico()
    {
        return $this->valorDaTaxaDeServico;
    }

    /**
     * @return mixed
     */
    public function getValorRejeitado()
    {
        return $this->valorRejeitado;
    }

    /**
     * @return mixed
     */
    public function getValorDeCredito()
    {
        return $this->valorDeCredito;
    }

    /**
     * @return mixed
     */
    public function getValorEncargos()
    {
        return $this->valorEncargos;
    }

    /**
     * @return mixed
     */
    public function getTipoDePagamento()
    {
        return $this->tipoDePagamento;
    }

    /**
     * @return mixed
     */
    public function getNumeroDaParcelaDoResumoDeVenda()
    {
        return $this->numeroDaParcelaDoResumoDeVenda;
    }

    /**
     * @return mixed
     */
    public function getQuantidadeDeParcelasDoResumoDeVenda()
    {
        return $this->quantidadeDeParcelasDoResumoDeVenda;
    }

    /**
     * @return mixed
     */
    public function getCodigoDoEstabelecimentoCentralizadorDosPagamentos()
    {
        return $this->codigoDoEstabelecimentoCentralizadorDosPagamentos;
    }

    /**
     * @return mixed
     */
    public function getTransacoes()
    {
        return $this->transacoes;
    }

    /**
     * @return mixed
     */
    public function getAjustes()
    {
        return $this->ajustes;
    }

    /**
     * @param Transacao $transacao
     */
    public function addTransacao(Transacao $transacao)
    {
        $transacao->setResumoDeVenda($this);
        $this->transacoes[] = $transacao;
    }

    /**
     * @param Ajuste $ajuste
     */
    public function addAjuste(Ajuste $ajuste)
    {
        $ajuste->setResumoDeVenda($this);
        $this->ajustes[] = $ajuste;
    }

    /**
     * @return mixed
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
        $this->header = $header;
    }

    /**
     * @return mixed
     */
    public function getContaCorrenteBanco()
    {
        return $this->contaCorrenteBanco;
    }

    /**
     * @param mixed $contaCorrenteBanco
     */
    public function setContaCorrenteBanco($contaCorrenteBanco)
    {
        $this->contaCorrenteBanco = $contaCorrenteBanco;
    }

    /**
     * @return mixed
     */
    public function getContaCorrenteAgencia()
    {
        return $this->contaCorrenteAgencia;
    }

    /**
     * @param mixed $contaCorrenteAgencia
     */
    public function setContaCorrenteAgencia($contaCorrenteAgencia)
    {
        $this->contaCorrenteAgencia = $contaCorrenteAgencia;
    }

    /**
     * @return mixed
     */
    public function getContaCorrenteNumero()
    {
        return $this->contaCorrenteNumero;
    }

    /**
     * @param mixed $contaCorrenteNumero
     */
    public function setContaCorrenteNumero($contaCorrenteNumero)
    {
        $this->contaCorrenteNumero = $contaCorrenteNumero;
    }

    /**
     * @param mixed $codigoDoEstabelecimento
     */
    public function setCodigoDoEstabelecimento($codigoDoEstabelecimento)
    {
        $this->codigoDoEstabelecimento = $codigoDoEstabelecimento;
    }

    /**
     * @param mixed $produto
     */
    public function setProduto($produto)
    {
        if(!in_array($produto, Produto::getValues())){
            throw new \InvalidArgumentException("Produto $produto desconhecido");
        }
        $this->produto = $produto;
    }

    /**
     * @param mixed $formaDeCaptura
     */
    public function setFormaDeCaptura($formaDeCaptura)
    {
        if(!in_array($formaDeCaptura, FormaDeCaptura::getValues()) && !empty($tipoDePagamento)){
            throw new \InvalidArgumentException("Forma de captura $formaDeCaptura inválida");
        }
        $this->formaDeCaptura = $formaDeCaptura;
    }

    /**
     * @param mixed $numeroDoResumoDeVendas
     */
    public function setNumeroDoResumoDeVendas($numeroDoResumoDeVendas)
    {
        $this->numeroDoResumoDeVendas = $numeroDoResumoDeVendas;
    }

    /**
     * @param mixed $dataDoResumoDeVenda
     */
    public function setDataDoResumoDeVenda($dataDoResumoDeVenda)
    {
        $this->dataDoResumoDeVenda = $dataDoResumoDeVenda;
    }

    /**
     * @param mixed $dataDoPagamentoDoResumoDeVendas
     */
    public function setDataDoPagamentoDoResumoDeVendas($dataDoPagamentoDoResumoDeVendas)
    {
        $this->dataDoPagamentoDoResumoDeVendas = $dataDoPagamentoDoResumoDeVendas;
    }

    /**
     * @param mixed $numeroDosComprovantesDeVendaAceitos
     */
    public function setNumeroDosComprovantesDeVendaAceitos($numeroDosComprovantesDeVendaAceitos)
    {
        $this->numeroDosComprovantesDeVendaAceitos = $numeroDosComprovantesDeVendaAceitos;
    }

    /**
     * @param mixed $numeroDosComprovantesDeVendaRejeitados
     */
    public function setNumeroDosComprovantesDeVendaRejeitados($numeroDosComprovantesDeVendaRejeitados)
    {
        $this->numeroDosComprovantesDeVendaRejeitados = $numeroDosComprovantesDeVendaRejeitados;
    }

    /**
     * @param mixed $valorBruto
     */
    public function setValorBruto($valorBruto)
    {
        $this->valorBruto = $valorBruto;
    }

    /**
     * @param mixed $valorLiquido
     */
    public function setValorLiquido($valorLiquido)
    {
        $this->valorLiquido = $valorLiquido;
    }

    /**
     * @param mixed $valorDaTaxaDeServico
     */
    public function setValorDaTaxaDeServico($valorDaTaxaDeServico)
    {
        $this->valorDaTaxaDeServico = $valorDaTaxaDeServico;
    }

    /**
     * @param mixed $valorRejeitado
     */
    public function setValorRejeitado($valorRejeitado)
    {
        $this->valorRejeitado = $valorRejeitado;
    }

    /**
     * @param float $valorDeCredito
     */
    public function setValorDeCredito($valorDeCredito)
    {
        $this->valorDeCredito = $valorDeCredito;
    }

    /**
     * @param float $valorEncargos
     */
    public function setValorEncargos($valorEncargos)
    {
        $this->valorEncargos = $valorEncargos;
    }

    /**
     * @param string $tipoDePagamento
     */
    public function setTipoDePagamento($tipoDePagamento)
    {
        if(!in_array($tipoDePagamento, TipoDePagamento::getValues()) && !empty($tipoDePagamento)){
            throw new \InvalidArgumentException("Tipo de pagamento $tipoDePagamento inválido");
        }
        $this->tipoDePagamento = $tipoDePagamento;
    }

    /**
     * @param integer $numeroDaParcelaDoResumoDeVenda
     */
    public function setNumeroDaParcelaDoResumoDeVenda($numeroDaParcelaDoResumoDeVenda)
    {
        $this->numeroDaParcelaDoResumoDeVenda = $numeroDaParcelaDoResumoDeVenda;
    }

    /**
     * @param integer $quantidadeDeParcelasDoResumoDeVenda
     */
    public function setQuantidadeDeParcelasDoResumoDeVenda($quantidadeDeParcelasDoResumoDeVenda)
    {
        $this->quantidadeDeParcelasDoResumoDeVenda = $quantidadeDeParcelasDoResumoDeVenda;
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
    public function getValorDaTaxaDeDesconto()
    {
        return $this->valorDaTaxaDeDesconto;
    }

    /**
     * @param mixed $valorDaTaxaDeDesconto
     */
    public function setValorDaTaxaDeDesconto($valorDaTaxaDeDesconto)
    {
        $this->valorDaTaxaDeDesconto = $valorDaTaxaDeDesconto;
    }

    public function isConfirmacaoDePagamento()
    {
        return (in_array($this->tipoDePagamento, TipoDePagamento::getValuesConfirmacaoDePagamento()));
    }

    public function isPagamentoFuturo()
    {
        return (in_array($this->tipoDePagamento, TipoDePagamento::getValuesPagamentoFuturo()));
    }

}