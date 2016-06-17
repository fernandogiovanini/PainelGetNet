<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 04/03/15
 * Time: 16:53
 */

namespace PainelGetNet\AppBundle\Entity\GetNet\Statement;

use PainelGetNet\AppBundle\Exception\GetNet\InvalidLineException;

class HeaderFactory extends AbstractMapper{

    public function __construct(){
        $this->loadMappings();
    }

    public function createFromStatementLine($line){
        $lineType = (strlen($line)>0)?$line[0]:null;
        if($lineType !== '0'){
            throw new InvalidLineException("A linha informada não corresponde a um header: {$line}");
        }
        $this->extractAllData($line);
        return $this->createFromMapped();
    }

    public function loadMappings(){
        $this->addFieldMapping('tipo_de_registro', 0, 1);
        $this->addFieldMapping('data_hora_criacao_arquivo', 1, 14);
        $this->addFieldMapping('data_referencia_movimento', 15, 8);
        $this->addFieldMapping('arquivo_e_versao', 23, 8);
        $this->addFieldMapping('codigo_do_estabelecimento', 31, 15);
        $this->addFieldMapping('cnpj', 46, 14);
        $this->addFieldMapping('nome_adquirente', 60, 20);
        $this->addFieldMapping('sequencia', 80, 9);
        $this->addFieldMapping('codigo_do_adquirente', 89, 2);
    }

    protected function createFromMapped(){
        $header = new Header();
        $header->setDataHoraDeCriacaoDoArquivo(\DateTime::createFromFormat('dmYHis', $this->mapped['data_hora_criacao_arquivo']));
        $header->setDataDeReferenciaDoMovimento(\DateTime::createFromFormat('dmY', $this->mapped['data_referencia_movimento']));
        $header->setArquivoEVersao(trim($this->mapped['arquivo_e_versao']));
        $header->setCodigoDoEstabelecimento((int)$this->mapped['codigo_do_estabelecimento']);
        $header->setCnpj(trim($this->mapped['cnpj']));
        $header->setNomeDoAdquirente(trim($this->mapped['nome_adquirente']));
        $header->setSequencia((int)$this->mapped['sequencia']);
        $header->setCodigoDoAdquirente($this->mapped['codigo_do_adquirente']);
        return $header;
    }

}