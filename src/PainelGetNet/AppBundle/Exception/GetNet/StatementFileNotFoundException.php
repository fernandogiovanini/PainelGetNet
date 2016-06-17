<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 03/03/15
 * Time: 11:24
 */

namespace PainelGetNet\AppBundle\Exception\GetNet;

use Symfony\Component\Filesystem\Exception\FileNotFoundException;

/**
 * Class StatementNotFoundException
 *
 * Exception thrown when the GetNet Statement file is
 * not found in the local filesystem
 */
class StatementFileNotFoundException extends FileNotFoundException {

    /**
     * @inheritdoc
     */
    public function __construct($message = null, $code = 0, \Exception $previous = null, $path = null)
    {
        parent::__construct($message,$code,$previous,$path);
    }
}