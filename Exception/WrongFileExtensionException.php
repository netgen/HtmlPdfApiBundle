<?php
/**
 * Created by PhpStorm.
 * User: Hex
 * Date: 24/06/14
 * Time: 16:00
 */

namespace Netgen\HtmlPdfApiBundle\Exception;

use Exception;

class WrongFileExtensionException extends Exception {

    public function __construct ($message)
    {
        parent::__construct($message);
    }

} 