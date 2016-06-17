<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 09/03/15
 * Time: 11:17
 */

namespace PainelGetNet\AppBundle\Entity\GetNet;


class TipoDeMovimento
{
    const PAGAMENTO_NORMAL = 'PG';
    const ANTECIPACAO_DE_CREDITO = 'AC';
    const PAGAMENTO_DE_ANTECIPACAO = 'PR';

    public static function getTiposDeMovimentos(){
        return [
            self::PAGAMENTO_NORMAL => 'Pagamento normal',
            self::ANTECIPACAO_DE_CREDITO => 'Antecipação de crédito',
            self::PAGAMENTO_DE_ANTECIPACAO => 'Pagamento de antecipação'
        ];
    }

    public static function getValues(){
        return array_keys(self::getTiposDeMovimentos());
    }

    public static function getLabel($tipoDeMovimento){
        $tiposDeMovimentos = self::getTiposDeMovimentos();
        return array_key_exists($tipoDeMovimento, $tiposDeMovimentos)?$tiposDeMovimentos[$tipoDeMovimento]:$tipoDeMovimento;
    }
}