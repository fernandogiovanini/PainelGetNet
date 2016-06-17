<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 04/03/15
 * Time: 10:15
 */

namespace PainelGetNet\AppBundle\Entity\GetNet\Statement;


class Produto {

    const TITULO = '1';
    const CONVENIO = '2';
    const CREDITO_DIGITAL = '3';
    const CUPOM_ELETRONICO_1 = '00';
    const CUPOM_ELETRONICO_2 = 'CE';
    const CUPOM_PAPEL = 'CP';
    const CARTAO_CREDITO_MASTERCARD = 'SM';
    const CARTAO_CREDITO_VISA = 'SV';
    const CARTAO_DEBITO_MAESTRO = 'SR';
    const CARTAO_DEBITO_VISA_ELECTRON = 'SE';
    const PAGAMENTO_CARNE_DEBITO_VISA_ELECTRON = 'PV';
    const PAGAMENTO_CARNE_DEBITO_MAESTRO = 'PM';
    const PAGAMENTO_RECORRENTE = 'PR';

    public static function getProdutos(){
        return [
            self::TITULO => 'Título',
            self::CONVENIO => 'Convênio',
            self::CREDITO_DIGITAL => 'Crédito Digital',
            self::CUPOM_ELETRONICO_1 => 'Cupom Eletrônico (00)',
            self::CUPOM_ELETRONICO_2 => 'Cupom Eletrônico (CE)',
            self::CUPOM_PAPEL => 'Cupom Papel',
            self::CARTAO_CREDITO_MASTERCARD => 'Cartão Crédito MASTERCARD',
            self::CARTAO_CREDITO_VISA => 'Cartão Crédito VISA',
            self::CARTAO_DEBITO_MAESTRO => 'Cartão Débito MAESTRO',
            self::CARTAO_DEBITO_VISA_ELECTRON => 'Cartão Débito VISA ELECTRON',
            self::PAGAMENTO_CARNE_DEBITO_VISA_ELECTRON => 'Pagamento Carnê – Débito VISA ELECTRON',
            self::PAGAMENTO_CARNE_DEBITO_MAESTRO => 'Pagamento Carnê – Débito MAESTRO',
            self::PAGAMENTO_RECORRENTE => 'Pagamento Recorrente'
        ];
    }

    public static function getValues(){
        return array_keys(self::getProdutos());
    }

    public static function getLabel($produto){
        $produtos = self::getProdutos();
        return array_key_exists($produto, $produtos)?$produtos[$produto]:$produto;
    }
}