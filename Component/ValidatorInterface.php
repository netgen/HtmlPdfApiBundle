<?php

namespace Netgen\HtmlPdfApiBundle\Component;


interface ValidatorInterface {

    /**
     * Validates request parameters for HtmlPdfApi
     *
     * @param array $parameters     Parameters to validate
     *
     * @return array $parameters    Validated parameters
     */
    public function validate($parameters);

} 