<?php

namespace Netgen\HtmlPdfApiBundle\Exception;

use Exception;

class InvalidParameterException extends Exception {

    /**
     * Constructor
     *
     * @param string $message   Message of the exception
     */
    public function __construct ($message)
    {
        parent::__construct($message);
    }
} 