<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 04/03/15
 * Time: 10:15
 */

namespace PainelGetNet\AppBundle\Entity\GetNet\Statement;


class FormaDeCaptura {

    const TEF = 'TEF';
    const POS = 'POS';
    const MANUAL = 'MAN';
    const INTERNET = 'INT';

    public static function getFormasDeCaptura(){
        return [
            self::TEF => 'TEF',
            self::POS => 'POS',
            self::MANUAL => 'Manual',
            self::INTERNET => 'Internet'
        ];
    }

    public static function getValues(){
        return array_keys(self::getFormasDeCaptura());
    }
}