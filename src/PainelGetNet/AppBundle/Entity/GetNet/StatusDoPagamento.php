<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 09/03/15
 * Time: 11:17
 */

namespace PainelGetNet\AppBundle\Entity\GetNet;


class StatusDoPagamento
{
    const A_RECEBER = 'A_RECEBER';
    const PAGO = 'PAGO';
    const CANCELADO = 'CANCELADO';

    public static function getStatusDoPagamento(){
        return [
            self::A_RECEBER => 'A receber',
            self::PAGO => 'Pago',
            self::CANCELADO => 'Cancelado'
        ];
    }

    public static function getValues(){
        return array_keys(self::getStatusDoPagamento());
    }

    public static function getLabel($statusDoPagamento){
        $status = self::getStatusDoPagamento();
        return array_key_exists($statusDoPagamento, $status)?$status[$statusDoPagamento]:$statusDoPagamento;
    }
}