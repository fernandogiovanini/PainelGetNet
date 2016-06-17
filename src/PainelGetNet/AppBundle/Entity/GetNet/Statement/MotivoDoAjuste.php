<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 04/03/15
 * Time: 10:15
 */

namespace PainelGetNet\AppBundle\Entity\GetNet\Statement;


class MotivoDoAjuste {

    const AJUSTE_A_CREDITO_OU_A_DEBITO = '1';
    const ALUGUEL_DE_POS = '2';
    const CANCELAMENTO = '3';
    const CHARGEBACK = '4';
    const REVARGA_TELECOM = '5';
    const BILHETAGEM = '6';
    const CONSULTA_SERASA = '7';
    const ALUGUEL_DE_VERTICAIS = '8';
    const CARGA_E_RECARGA_CARTAO_PRE_PAGO = '9';
    const MANUTENCAO_DE_CARTAO = '10';
    const VENDA_DE_CARTAO = '11';

    public static function getMotivosDoAjuste(){
        return [
            self::AJUSTE_A_CREDITO_OU_A_DEBITO => 'Ajuste à crédito ou à débito',
            self::ALUGUEL_DE_POS => 'Aluguel de POS',
            self::CANCELAMENTO => 'Chargeback',
            self::CHARGEBACK => 'Chargeback',
            self::REVARGA_TELECOM => 'Recarga Telecom',
            self::BILHETAGEM => 'Bilhetagem',
            self::CONSULTA_SERASA => 'Consulta Serasa',
            self::ALUGUEL_DE_VERTICAIS => 'Aluguel de Verticais',
            self::CARGA_E_RECARGA_CARTAO_PRE_PAGO => 'Carga e Recarga Cartão Pré Pago',
            self::MANUTENCAO_DE_CARTAO => 'Manutenção de Cartão',
            self::VENDA_DE_CARTAO => 'Venda de Cartão'
        ];
    }

    public static function getValues(){
        return array_keys(self::getMotivosDoAjuste());
    }
}