<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 04/03/15
 * Time: 16:53
 */

namespace PainelGetNet\AppBundle\Entity\GetNet\Statement;

use PainelGetNet\AppBundle\Exception\GetNet\InvalidLineException;

class TransacaoFactory extends AbstractMapper
{

    public function __construct()
    {
        $this->loadMappings();
    }

    public function createFromStatementLine($line)
    {
        $lineType = (strlen($line) > 0) ? $line[0] : null;
        if ($lineType !== '2') {
            throw new InvalidLineException("A linha informada não corresponde a um CV: {$line}");
        }
        $this->extractAllData($line);
        return $this->createFromMapped();
    }

    public function loadMappings()
    {
        $this->addFieldMapping('tipo_de_registro', 0, 1);
        $this->addFieldMapping('codigo_do_estabelecimento', 1, 15);
        $this->addFieldMapping('numero_do_rv', 16, 9);
        $this->addFieldMapping('nsu_do_adquirente', 25, 12);
        $this->addFieldMapping('data_hora_da_transacao', 37, 14);
        $this->addFieldMapping('numero_do_cartao', 51, 19);
        $this->addFieldMapping('valor_da_transacao', 70, 12);
        $this->addFieldMapping('valor_do_saque', 82, 12);
        $this->addFieldMapping('valor_da_taxa_de_servico', 94, 12);
        $this->addFieldMapping('numero_de_parcelas', 106, 2);
        $this->addFieldMapping('numero_da_parcela_paga', 108, 2);
        $this->addFieldMapping('valor_da_parcela_paga', 110, 12);
        $this->addFieldMapping('data_do_pagamento', 122, 8);
        $this->addFieldMapping('codigo_da_autorizacao', 130, 10);
        $this->addFieldMapping('forma_de_captura', 140, 3);
        $this->addFieldMapping('status_da_transacao', 143, 1);
        $this->addFieldMapping('codigo_do_estabelecimento_centralizador_dos_pagamentos', 144, 15);
        $this->addFieldMapping('numero_do_terminal', 159, 8);
    }

    protected function createFromMapped()
    {
        $transacao = new Transacao();
        $transacao->setCodigoDoEstabelecimento(trim($this->mapped['codigo_do_estabelecimento']));
        $transacao->setNumeroDoResumoDeVenda((int)$this->mapped['numero_do_rv']);
        $transacao->setNsuDoAdquirente((int)$this->mapped['nsu_do_adquirente']);
        $transacao->setDataHoraDaTransacao(\DateTime::createFromFormat('dmYHis', $this->mapped['data_hora_da_transacao']));
        $transacao->setNumeroDoCartao(trim($this->mapped['numero_do_cartao']));
        $transacao->setValorDaTransacao(((float)$this->mapped['valor_da_transacao'])/100);
        $transacao->setValorDoSaque(((float)$this->mapped['valor_do_saque'])/100);
        $transacao->setValorDaTaxaDeServico(((float)$this->mapped['valor_da_taxa_de_servico'])/100);
        $transacao->setNumeroDeParcelas((int)$this->mapped['numero_de_parcelas']);
        $transacao->setNumeroDaParcelaPaga((int)$this->mapped['numero_da_parcela_paga']);
        $transacao->setValorDaParcelaPaga(((float)$this->mapped['valor_da_parcela_paga'])/100);
        $transacao->setDataDoPagamento(\DateTime::createFromFormat('dmY', $this->mapped['data_do_pagamento']));
        $transacao->setCodigoDeAutorizacao(trim($this->mapped['codigo_da_autorizacao']));
        $transacao->setFormaDeCaptura(trim($this->mapped['forma_de_captura']));
        $transacao->setStatusDaTransacao(trim($this->mapped['status_da_transacao']));
        $transacao->setCodigoDoEstabelecimentoCentralizadorDosPagamentos(trim($this->mapped['codigo_do_estabelecimento_centralizador_dos_pagamentos']));
        $transacao->setNumeroDoTerminal(trim($this->mapped['numero_do_terminal']));
        return $transacao;
    }
}