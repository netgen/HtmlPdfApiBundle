<?php

namespace Netgen\HtmlPdfApiBundle\Exception;

use Exception;

class WrongFileExtensionException extends Exception {

    public function __construct ($message)
    {
        parent::__construct($message);
    }

} 