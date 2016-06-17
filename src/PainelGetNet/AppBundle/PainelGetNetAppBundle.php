<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 23/02/15
 * Time: 15:52
 */

namespace PainelGetNet\AppBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PainelGetNetAppBundle extends Bundle {

    public function getParent()
    {
        return 'SonataUserBundle';
    }
}