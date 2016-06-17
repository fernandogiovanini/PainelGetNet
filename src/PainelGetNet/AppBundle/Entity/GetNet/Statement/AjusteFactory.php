<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 04/03/15
 * Time: 16:53
 */

namespace PainelGetNet\AppBundle\Entity\GetNet\Statement;

use PainelGetNet\AppBundle\Exception\GetNet\InvalidLineException;

class AjusteFactory extends AbstractMapper
{

    public function __construct()
    {
        $this->loadMappings();
    }

    public function createFromStatementLine($line)
    {
        $lineType = (strlen($line) > 0) ? $line[0] : null;
        if ($lineType !== '3') {
            throw new InvalidLineException("A linha informada não corresponde a um ajuste: {$line}");
        }
        $this->extractAllData($line);
        return $this->createFromMapped();
    }

    public function loadMappings()
    {
        $this->addFieldMapping('tipo_de_registro', 0, 1);
        $this->addFieldMapping('codigo_do_estabelecimento', 1, 15);
        $this->addFieldMapping('numero_do_rv_ajustado', 16, 9);
        $this->addFieldMapping('data_do_rv', 25, 8);
        $this->addFieldMapping('data_do_pagamento_do_rv', 33, 8);
        $this->addFieldMapping('identificador_do_ajuste', 41, 20);
        $this->addFieldMapping('sinal_do_valor_do_ajuste', 62, 1);
        $this->addFieldMapping('valor_do_ajuste', 63, 12);
        $this->addFieldMapping('motivo_do_ajuste', 75, 2);
        $this->addFieldMapping('data_da_carta', 77, 8);
        $this->addFieldMapping('numero_do_cartao', 85, 19);
        $this->addFieldMapping('numero_do_rv_original', 104, 9);
        $this->addFieldMapping('nsu_do_adquirente', 113, 12);
        $this->addFieldMapping('data_da_transacao_original', 125, 8);
        $this->addFieldMapping('tipo_de_pagamento', 133, 2);
        $this->addFieldMapping('numero_do_terminal', 135, 8);
        $this->addFieldMapping('data_do_pagamento', 143, 8);
    }

    protected function createFromMapped()
    {
        $ajuste = new Ajuste();
        $ajuste->setCodigoDoEstabelecimento(trim($this->mapped['codigo_do_estabelecimento']));
        $ajuste->setNumeroDoResumoDeVendaAjustado((int)$this->mapped['numero_do_rv_ajustado']);
        $ajuste->setDataDoResumoDeVenda(\DateTime::createFromFormat('dmY', $this->mapped['data_do_rv']));
        $ajuste->setDataDoPagamentoDoResumoDeVenda(\DateTime::createFromFormat('dmY', $this->mapped['data_do_pagamento_do_rv']));
        $ajuste->setIdentificadorDoAjuste(trim($this->mapped['identificador_do_ajuste']));
        $ajuste->setSinalDoValorDoAjuste(trim($this->mapped['sinal_do_valor_do_ajuste']));
        $ajuste->setValorDoAjuste(((float)$this->mapped['valor_do_ajuste'])/100);
        $ajuste->setMotivoDoAjuste(trim($this->mapped['motivo_do_ajuste']));
        $ajuste->setDataDaCarta(\DateTime::createFromFormat('dmY', $this->mapped['data_da_carta']));
        $ajuste->setNumeroDoCartao(trim($this->mapped['numero_do_cartao']));
        $ajuste->setNsuDoAdquirente((int)$this->mapped['nsu_do_adquirente']);
        $dataDaTransacaoOriginal = \DateTime::createFromFormat('dmY', $this->mapped['data_da_transacao_original']);
        $ajuste->setDataDaTransacaoOriginal(($dataDaTransacaoOriginal)?:null);
        $ajuste->setTipoDePagamento(trim($this->mapped['tipo_de_pagamento']));
        $ajuste->setNumeroDoTerminal(trim($this->mapped['numero_do_terminal']));
        $dataDoPagamento = \DateTime::createFromFormat('dmY', $this->mapped['data_do_pagamento']);
        $ajuste->setDataDoPagamento(($dataDoPagamento)?:null);
        return $ajuste;
    }
}