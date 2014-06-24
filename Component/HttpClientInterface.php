<?php

namespace Netgen\HtmlPdfApiBundle\Component;


interface HttpClientInterface {
    public function sendRequest($url, $params, $method);
} 