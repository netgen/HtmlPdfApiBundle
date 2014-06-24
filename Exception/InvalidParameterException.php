<?php

namespace Netgen\HtmlPdfApiBundle\Exception;

use Exception;

class InvalidParameterException extends Exception {

    public function __construct ($message)
    {
        parent::__construct($message);
    }
} 