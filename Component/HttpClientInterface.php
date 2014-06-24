<?php
/**
 * Created by PhpStorm.
 * User: Hex
 * Date: 23/06/14
 * Time: 17:37
 */

namespace Netgen\HtmlPdfApiBundle\Component;


interface HttpClientInterface {
    public function sendRequest($url, $params, $method);
} 