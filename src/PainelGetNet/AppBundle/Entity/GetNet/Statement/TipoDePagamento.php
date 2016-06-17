<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 04/03/15
 * Time: 10:15
 */

namespace PainelGetNet\AppBundle\Entity\GetNet\Statement;


class TipoDePagamento {

    const PAGAMENTO_FUTURO = 'PF';
    const PAGAMENTO_NORMAL = 'PG';
    const ANTECIPACAO_DE_CREDITO = 'AC';
    const REJEICAO_DE_ANTECIPACAO = 'RA';
    const PAGAMENTO_DE_ANTECIPACAO_REJEITADA = 'PR';

    public static function getTiposDePagamento(){
        return [
            self::PAGAMENTO_FUTURO => 'Pagamento Futuro (previsão)',
            self::PAGAMENTO_NORMAL => 'Pagamento Normal',
            self::ANTECIPACAO_DE_CREDITO => 'Antecipação de Crédito',
            self::REJEICAO_DE_ANTECIPACAO => 'Rejeição de Antecipação',
            self::PAGAMENTO_DE_ANTECIPACAO_REJEITADA => 'Pagamento da Antecipação Rejeitada'
        ];
    }

    public static function getValues()
    {
        return array_keys(self::getTiposDePagamento());
    }

    public static function getValuesConfirmacaoDePagamento()
    {
        return [
            self::PAGAMENTO_NORMAL,
            self::ANTECIPACAO_DE_CREDITO,
            self::PAGAMENTO_DE_ANTECIPACAO_REJEITADA
        ];
    }

    public static function getValuesPagamentoFuturo()
    {
        return [
            self::PAGAMENTO_FUTURO
        ];
    }
}