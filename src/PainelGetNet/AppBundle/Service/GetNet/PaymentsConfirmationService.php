<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 09/03/15
 * Time: 10:55
 */

namespace PainelGetNet\AppBundle\Service\GetNet;

use PainelGetNet\AppBundle\Entity\GetNet\Pagamento;
use Psr\Log\LoggerInterface;

class PaymentsConfirmationService
{
    private $logger;

    /**
     * Set the logger interface
     *
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function extractPayments(array $resumosDeVendas)
    {
        $pagamentos = [];
        foreach($resumosDeVendas as $resumoDeVenda){
            $pagamentos[] = Pagamento::createFromResumoDeVenda($resumoDeVenda);
        }
        return $pagamentos;
    }

    public function extractPaymentsConfirmations(array $resumosDeVendas)
    {
        $pagamentos = [];
        foreach($resumosDeVendas as $resumoDeVenda){
            $pagamentos[] = Pagamento::createFromPaymentConfirmation($resumoDeVenda);
        }
        return $pagamentos;
    }
}