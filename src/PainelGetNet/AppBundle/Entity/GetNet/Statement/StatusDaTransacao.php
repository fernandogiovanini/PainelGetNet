<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 04/03/15
 * Time: 10:15
 */

namespace PainelGetNet\AppBundle\Entity\GetNet\Statement;


class StatusDaTransacao {

    const APROVADA = 'C';
    const CANCEALADA = 'X';
    const ESTORNO = 'E';

    public static function getStatusDaTransacao(){
        return [
            self::APROVADA => 'Aprovada',
            self::CANCEALADA => 'Cancelada',
            self::ESTORNO => 'Estorno'
        ];
    }

    public static function getValues(){
        return array_keys(self::getStatusDaTransacao());
    }
}