<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 03/03/15
 * Time: 20:14
 */

namespace PainelGetNet\AppBundle\Entity\GetNet\Statement;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class ContaCorrente
 *
 *
 *
 */
class ContaCorrente {

    /**
     * @var
     *
     * @ORM\Column(
     *      type="integer"
     * )
     */
    private $banco;

    /**
     * @var
     *
     * @ORM\Column(
     *      type="integer"
     * )
     */
    private $agencia;

    /**
     * @var
     *
     * @ORM\Column(
     *      type="integer"
     * )
     */
    private $numero;

    public function __construct($banco, $agencia, $conta){
        $this->setBanco($banco);
        $this->setAgencia($agencia);
        $this->setNumero($conta);
    }

    /**
     * @param mixed $banco
     */
    private function setBanco($banco)
    {
        $this->banco = $banco;
    }

    /**
     * @param mixed $agencia
     */
    private function setAgencia($agencia)
    {
        $this->agencia = $agencia;
    }

    /**
     * @param mixed $numero
     */
    private function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * @return mixed
     */
    public function getBanco()
    {
        return $this->banco;
    }

    /**
     * @return mixed
     */
    public function getAgencia()
    {
        return $this->agencia;
    }

    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }
}