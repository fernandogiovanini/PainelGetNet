<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 04/03/15
 * Time: 16:53
 */

namespace PainelGetNet\AppBundle\Entity\GetNet\Statement;

use PainelGetNet\AppBundle\Exception\GetNet\InvalidLineException;

class ResumoDeVendaFactory extends AbstractMapper
{

    public function __construct()
    {
        $this->loadMappings();
    }

    public function createFromStatementLine($line)
    {
        $lineType = (strlen($line) > 0) ? $line[0] : null;
        if ($lineType !== '1') {
            throw new InvalidLineException("A linha informada não corresponde a um RV: {$line}");
        }
        $this->extractAllData($line);
        return $this->createFromMapped();
    }

    public function loadMappings()
    {
        $this->addFieldMapping('tipo_de_registro', 0, 1);
        $this->addFieldMapping('codigo_do_estabelecimento', 1, 15);
        $this->addFieldMapping('codigo_do_produto', 16, 2);
        $this->addFieldMapping('forma_de_captura', 18, 3);
        $this->addFieldMapping('numero_do_rv', 21, 9);
        $this->addFieldMapping('data_do_rv', 30, 8);
        $this->addFieldMapping('data_do_pagamento', 38, 8);
        $this->addFieldMapping('banco', 46, 3);
        $this->addFieldMapping('agencia', 49, 6);
        $this->addFieldMapping('conta_corrente', 55, 11);
        $this->addFieldMapping('numero_dos_cvs_aceitos', 66, 9);
        $this->addFieldMapping('numero_dos_cvs_rejeitados', 75, 9);
        $this->addFieldMapping('valor_bruto', 84, 12);
        $this->addFieldMapping('valor_liquido', 96, 12);
        $this->addFieldMapping('valor_taxa_de_servico', 108, 12);
        $this->addFieldMapping('valor_taxa_de_desconto', 120, 12);
        $this->addFieldMapping('valor_rejeitado', 132, 12);
        $this->addFieldMapping('valor_credito', 144, 12);
        $this->addFieldMapping('valor_encargos', 156, 12);
        $this->addFieldMapping('tipo_de_pagamento', 168, 2);
        $this->addFieldMapping('numero_da_parcela_do_rv', 170, 2);
        $this->addFieldMapping('quantidade_de_parcelas_do_rv', 172, 2);
        $this->addFieldMapping('codigo_do_estabelecimento_centralizador_dos_pagamentos', 174, 15);
    }

    protected function createFromMapped()
    {
        $resumoDeVendas = new ResumoDeVenda();
        $resumoDeVendas->setCodigoDoEstabelecimento(trim($this->mapped['codigo_do_estabelecimento']));
        $resumoDeVendas->setProduto(trim($this->mapped['codigo_do_produto']));
        $resumoDeVendas->setFormaDeCaptura(trim($this->mapped['forma_de_captura']));
        $resumoDeVendas->setNumeroDoResumoDeVendas((int)$this->mapped['numero_do_rv']);
        $resumoDeVendas->setDataDoResumoDeVenda(\DateTime::createFromFormat('dmY', $this->mapped['data_do_rv']));
        $resumoDeVendas->setDataDoPagamentoDoResumoDeVendas(\DateTime::createFromFormat('dmY', $this->mapped['data_do_pagamento']));
        $resumoDeVendas->setContaCorrenteBanco((int)$this->mapped['banco']);
        $resumoDeVendas->setContaCorrenteAgencia((int)$this->mapped['agencia']);
        $resumoDeVendas->setContaCorrenteNumero((int)$this->mapped['conta_corrente']);
        $resumoDeVendas->setNumeroDosComprovantesDeVendaAceitos((int)$this->mapped['numero_dos_cvs_aceitos']);
        $resumoDeVendas->setNumeroDosComprovantesDeVendaRejeitados((int)$this->mapped['numero_dos_cvs_rejeitados']);
        $resumoDeVendas->setValorBruto(((float)$this->mapped['valor_bruto'])/100);
        $resumoDeVendas->setValorLiquido(((float)$this->mapped['valor_liquido'])/100);
        $resumoDeVendas->setValorDaTaxaDeServico(((float)$this->mapped['valor_taxa_de_servico']/100));
        $resumoDeVendas->setValorDaTaxaDeDesconto(((float)$this->mapped['valor_taxa_de_desconto'])/100);
        $resumoDeVendas->setValorRejeitado(((float)$this->mapped['valor_rejeitado'])/100);
        $resumoDeVendas->setValorDeCredito(((float)$this->mapped['valor_credito'])/100);
        $resumoDeVendas->setValorEncargos(((float)$this->mapped['valor_encargos'])/100);
        $resumoDeVendas->setTipoDePagamento(trim($this->mapped['tipo_de_pagamento']));
        $resumoDeVendas->setNumeroDaParcelaDoResumoDeVenda((int)$this->mapped['numero_da_parcela_do_rv']);
        $resumoDeVendas->setQuantidadeDeParcelasDoResumoDeVenda((int)$this->mapped['quantidade_de_parcelas_do_rv']);
        $resumoDeVendas->setCodigoDoEstabelecimentoCentralizadorDosPagamentos(trim($this->mapped['codigo_do_estabelecimento_centralizador_dos_pagamentos']));
        return $resumoDeVendas;
    }

}